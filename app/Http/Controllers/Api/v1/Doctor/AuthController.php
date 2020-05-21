<?php

namespace App\Http\Controllers\Api\v1\Doctor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Doctors\DoctorRequest;
use App\Http\Resources\Doctor\DoctorResource;
use App\Http\Resources\patients\PatientResource;
use App\Models\Attachment;
use App\Models\Patient;
use App\Repositories\interfaces\DoctorRepository;
use App\Rules\CheckPassword;
use Illuminate\Http\JsonResponse;
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
        $this->middleware('auth:doctor_api', ['except' => ['login', 'verify', 'resendVerification', 'sendResetPassCode', 'resetPassword']]);
        auth()->setDefaultDriver('doctor_api');

        $this->repo = $repo;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function profile(Request $request)
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
            'old_password' => ['required_with:password', 'nullable', 'string
            ', 'max:191', new CheckPassword('doctors', auth()->user()->email)],
            'phone' => 'nullable|numeric|unique:doctors,phone,' . auth()->id(),
            'image' => 'nullable|image',
            'logo' => 'nullable|image',
            'license_number' => 'nullable|integer',
        ];

        \Validator::make($request->all(), $rules)->validate();

        $doctor = $this->repo->update(array_filter($request->all()), auth()->id());
        if ($request->image != null) {
            $image_data = $this->repo->saveFile($request->file('image'), 'doctors');
            $doctor->image()->updateOrCreate(['type' => $image_data['type']], $image_data);
        }
        if ($request->logo != null) {
            $logo_data = $this->repo->saveFile($request->file('logo'), 'doctors', Attachment::DOCTOR_Logo);
            $doctor->logo_image()->updateOrCreate(['type' => $logo_data['type']], $logo_data);
        }

        $response = (new DoctorResource($doctor))->jsonSerialize();
        $response['token'] = auth()->refresh();
        $doctor->setCache(config('session.lifetime') * 60);

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
        $this->validate($request, $roles, ['email.exists:' . __("Email or Password is incorrect")]);
        $credentials = request(['email', 'password']);
        $doctor = $this->repo->findWhere(request()->only('email'))->first();

        if ($doctor->phone_verified_at == null) {
            //TODO::send verifcation code on mobile
            return $this->UnauthorizedResponse(__('Please Verify Your Account'));
        }

        if (!$token = auth()->attempt($credentials)) {
            return $this->UnauthorizedResponse(__('Password is incorrect'));
        }
        auth()->user()->setCache(config('session.lifetime') * 60);

        $this->repo->AddFCM($request, $doctor);


        return responseJson(
            ['doctor' =>
                ['token' => $token] +
                (new  DoctorResource(auth()->user()))->jsonSerialize()


            ], __("Logged In Successfully"));
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->user()->pullCache();
        auth()->logout();

        return responseJson(null, __("Successfully logged out"));
    }


    public function verify(Request $request)
    {
        $this->validate($request, ['verification_code' => 'required|integer|exists:doctors,verification_code']);

        $doctor = $this->repo->verify($request);


        if (!$token = auth()->login($doctor)) {

            return $this->UnauthorizedResponse(__('Unauthorized'));

        }

        auth()->user()->setCache(config('session.lifetime') * 60);

        return responseJson(
            ['doctor' =>
                ['token' => $token] + (new DoctorResource($doctor->fresh()))->jsonSerialize()

            ], __("Verified Successfully"));
    }

    /**
     * send verification code to doctor
     * @param Request $request
     * @return JsonResponse
     */
    public function resendVerification(Request $request)
    {
        $request->validate(
            ['email' => 'required|email|exists:doctors,email']
        );

        $doctor = $this->repo->where($request->only('email'))->first();
        if ($doctor) {
            //TODO::send SMS verification

            return responseJson(['doctor' => new DoctorResource($doctor)], __("Code Send Successfully"));
        }
        if ($doctor) {
            return responseJson(null, __("Email Not Found"), 401);
        }
    }

    /**
     * handle Unauthorized response  of mobile developer return errors in key errors  as array of strings
     * @param mixed ...$msg
     * @return JsonResponse
     */

    protected function UnauthorizedResponse(...$msg): JsonResponse
    {

        return response()->json(
            [
                'status' => 2,
                'message' => isset($msg[0]) ? $msg[0] : __('Unauthorized'),
                'errors' => $msg,
                'data' => null

            ], 401);
    }


    public function sendResetPassCode(Request $request)
    {

        $this->validate($request, [
            'email' => 'required|email|exists:doctors,email',
        ]);
        $code = $this->repo->generateResetCode();
        $this->repo->where('email', $request->email)->update(['reset_password_code' => $code]);

        return responseJson(['code' => $code], __("Code Sent"));
    }

    public function resetPassword(Request $request)
    {

        $this->validate($request, [
            'code' => 'required|integer|exists:doctors,reset_password_code',
            'password' => 'required|string|confirmed'
        ]);
        $this->repo->where('reset_password_code', $request->code)->update(['password' => \Hash::make($request->password), 'reset_password_code' => null]);

        return responseJson(null, __("Password Updated"));
    }
}
