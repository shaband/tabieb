<?php

namespace App\Http\Controllers\Api\v1\Doctor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Doctors\DoctorRequest;
use App\Http\Resources\Doctor\DoctorResource;
use App\Repositories\interfaces\DoctorRepository;
use App\Rules\CheckPassword;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public $repo;

    public function __construct(DoctorRepository $repo)
    {
        $this->middleware('auth:doctor_api', ['except' => ['login', 'verify']]);
        auth()->setDefaultDriver('doctor_api');

        $this->repo = $repo;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        $rules = [
            "first_name_ar" => "nullable|string|max:191",
            "last_name_ar" => "nullable|string|max:191",
            "first_name_en" => "nullable|string|max:191",
            "last_name_en" => "nullable|string|max:191",
            "description_ar" => "nullable|string",
            "description_en" => "nullable|string",
            "title_ar" => "nullable|string|max:191",
            "title_en" => "nullable|string|max:191",
            "civil_id" => "nullable|numeric",
            "price" => "nullable|numeric",
            "period" => "nullable|numeric",
            "category_id" => 'nullable|integer|exists:categories,id,category_id,NULL',
            "sub_category_ids" => 'nullable|array',
            "sub_category_ids.*" => 'nullable|exists:categories,id,category_id,' . $request->category_id ?? auth()->user()->category_id,
            'email' => 'nullable|email|max:191|unique:doctors,id,' . auth()->id(),
            'password' => 'nullable|string|max:191|confirmed',
            'old_password' =>  ['required_with:password', 'nullable', 'string
            ', 'max:191', new CheckPassword('doctors', auth()->user()->email)],
            'phone' => 'nullable|numeric|unique:doctors,phone,' .  auth()->id(),
            'image' => 'nullable|image',
        ];

        \Validator::make($request->all(), $rules)->validate();

        $doctor = $this->repo->update(array_filter($request->all()), auth()->id());
        if ($request->image != null) {
            $image_data = $this->repo->saveFile($request->file('image'), 'doctors');
            $doctor->image()->updateOrCreate(['type' => $image_data['type']], $image_data);
        }

        $response = (new DoctorResource($doctor));
        return responseJson(['doctor' => $response]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        $roles = [
            'email' => 'required|email|exists:doctors,email',
            'password' => 'required|string|max:191',
            'device' => 'nullable|array',
            'device.device_type' => 'nullable|integer',
            'device.token' => 'nullable|string',
            'device.token_type' => 'nullable|integer'
        ];
        $this->validate($request, $roles);
        $credentials = request(['email', 'password']);
        $doctor = $this->repo->findWhere(request()->only('email'))->first();

        if ($doctor->phone_verified_at == null) {
            return response()->json(['data' => __('Please Verify Your Account')], 401);
        }

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $this->repo->AddFCM($request, $doctor);
        $doctorResource = new  DoctorResource(auth()->user());

        return responseJson(['doctor' => $doctorResource, 'token' => $token]);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return responseJson(null, __("Successfully logged out"));
    }


    public function verify(Request $request)
    {
        $this->validate($request, ['verification_code' => 'required|integer|exists:doctors,verification_code']);

        $doctor = $this->repo->verify($request);

        return responseJson(['student' => new DoctorResource($doctor->fresh())], __("Verified Successfully"));
    }

}
