<?php

namespace App\Http\Controllers\Api\v1\Patient;

use App\Http\Controllers\Controller;
use App\Http\Resources\patients\PatientResource;
use App\Repositories\interfaces\PatientRepository;
use App\Rules\CheckPassword;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public $repo;

    public function __construct(PatientRepository $repo)
    {
        $this->middleware('auth:patient_api', ['except' => ['login', 'register', 'verify']]);
        auth()->setDefaultDriver('patient_api');

        $this->repo = $repo;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function register(Request $request)
    {

        $rules = [
            'username' => 'nullable|string|max:191',
            'first_name' => 'required|string|max:191',
            'last_name' => 'required|string|max:191',
            'email' => 'required|email|unique:patients,email',
            'phone' => 'required|numeric|unique:patients,phone',
            'password' => 'required|string|max:191|confirmed',
            'civil_id' => 'required|numeric|unique:patients,civil_id',
            'social_security_id' => 'nullable|integer|exists:social_securities,id',
            'birthdate' => 'nullable|date|date_format:Y-m-d',
            'district_id' => 'nullable|integer|exists:districts,id',
            'area_id' => 'nullable|integer|exists:areas,id',
            'gender' => 'nullable|integer|min:1|max:2',
            'fb_token' => 'nullable|string',
            'google_token' => 'nullable|string',
            'device' => 'nullable|array',
            'device.device_type' => 'nullable|integer',
            'device.token' => 'nullable|string',
            'device.token_type' => 'nullable|integer'
        ];

        \Validator::make($request->all(), $rules)->validate();


        $patient = $this->repo->store($request);

        $response = (new PatientResource($patient));
        return responseJson(['patient' => $response]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function profile(Request $request)
    {
        $rules = [
            'username' => 'nullable|string|max:191',
            'first_name' => 'nullable|string|max:191',
            'last_name' => 'nullable|string|max:191',
            'email' => 'nullable|email|unique:patients,email,' . auth()->id(),
            'phone' => 'nullable|numeric|unique:patients,phone,' . auth()->id(),
            'old_password' => ['required_with:password', 'nullable', 'string'
                , 'max:191', new CheckPassword('patients', auth()->user()->email)],
            'password' => 'nullable|string|max:191|confirmed',
            'civil_id' => 'nullable|numeric|unique:patients,civil_id,' . auth()->id(),
            'social_security_id' => 'nullable|integer|exists:social_securities,id',
            'birthdate' => 'nullable|date|date_format:Y-m-d',
            'district_id' => 'nullable|integer|exists:districts,id',
            'area_id' => 'nullable|integer|exists:areas,id',
            'gender' => 'nullable|integer|min:1|max:2',
'image'=>'nullable|image'
        ];

        \Validator::make($request->all(), $rules)->validate();

        $patient = $this->repo->update(array_filter($request->all()), auth()->id());
        if ($request->image != null) {
            $image_data = $this->repo->saveFile($request->file('image'), 'patients');
            $patient->image()->updateOrCreate(['type' => $image_data['type']], $image_data);
        }

        $response = (new PatientResource($patient))->jsonSerialize();

        $response['token'] = auth()->refresh();
        return responseJson(['patient' => $response]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {

        $roles = [
            'email' => 'required|email|exists:patients,email',
            'password' => 'required|string|max:191',
            'device.device_type' => 'nullable|integer',
            'device.token' => 'nullable|string',
            'device.token_type' => 'nullable|integer'
        ];
        $this->validate($request, $roles);
        $credentials = request(['email', 'password']);
        $patient = $this->repo->findWhere(request()->only('email'))->first();

        if (!Hash::check($request->password, $patient->password)) {
            return $this->UnauthorizedResponse(__('Wrong Password'));

        }
        if ($patient->phone_verified_at == null) {
            return $this->UnauthorizedResponse(__('Please Verify Your Account'));

        }
        $this->repo->AddFCM($request, $patient);


        if (!$token = auth()->attempt($credentials)) {
            return $this->UnauthorizedResponse(__('Unauthorized'));

        }

        $patientResource = (new  PatientResource(auth()->user()))->jsonSerialize();

        return responseJson(['patient' => $patientResource + ['token' => $token]]);
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
        $this->validate($request, ['verification_code' => 'required|integer|exists:patients,verification_code']);

        $patient = $this->repo->verify($request);

        if (!$token = auth()->login($patient)) {

            return $this->UnauthorizedResponse(__('Unauthorized'));

        }

        return responseJson(
            [
                'patient' => [
                    (new PatientResource($patient->fresh()))->jsonSerialize()
                    + ['token' => $token]
                ]
            ],
            __("Verified Successfully")
        );
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
}
