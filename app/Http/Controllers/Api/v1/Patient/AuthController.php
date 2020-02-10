<?php

namespace App\Http\Controllers\Api\v1\Patient;

use App\Http\Controllers\Controller;
use App\Http\Resources\patients\PatientResource;
use App\Models\Patient;
use App\Repositories\interfaces\PatientRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $credentials = request(['email', 'password']);

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $response = (new PatientResource($patient));
        return responseJson(['patient' => $response, 'token' => $token]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function profile(Request $request)
    {
        $rules = [
            'first_name' => 'nullable|string|max:191',
            'last_name' => 'nullable|string|max:191',
            'email' => 'nullable|email|unique:patients,email,' . auth()->id(),
            'phone' => 'nullable|numeric|unique:patients,phone,' . auth()->id(),
            'password' => 'nullable|string|max:191|confirmed',
            'civil_id' => 'nullable|numeric|unique:patients,civil_id,' . auth()->id(),
            'social_security_id' => 'nullable|integer|exists:social_securities,id',
            'birthdate' => 'nullable|date|date_format:Y-m-d',
            'district_id' => 'nullable|integer|exists:districts,id',
            'area_id' => 'nullable|integer|exists:areas,id',
            'gender' => 'nullable|integer|min:1|max:2',
            'fb_token' => 'nullable|string',
            'google_token' => 'nullable|string',

        ];

        \Validator::make($request->all(), $rules)->validate();

        $patient = $this->repo->update(array_filter($request->all()), auth()->id());

        $response = (new PatientResource($patient));
        return responseJson(['patient' => $response]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);
        $patient = $this->repo->findWhere(request()->only('email'))->first();

        if ($patient->phone_verified_at == null) {
            return response()->json(['data' => __('Please Verify Your Account')], 401);
        }

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $patientResource = new  PatientResource(auth()->user());
        return responseJson(['patient' => $patientResource, 'token' => $token]);
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

        return responseJson(['student' => new PatientResource($patient->fresh())], __("Verified Successfully"));
    }

}
