<?php

namespace App\Http\Controllers\Website\Patient;

use App\Http\Controllers\Controller;
use App\Http\Resources\patients\PatientResource;
use App\Repositories\interfaces\PatientRepository;
use App\Repositories\interfaces\ReservationRepository;
use App\Rules\CheckPassword;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PatientController extends Controller
{

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public $repo;

    public function __construct(PatientRepository $repo)
    {
        $this->repo = $repo;
    }

    public function edit()
    {

        $user = auth()->user();

        return view('website.patient.profile.profile', compact('user'));
    }

    public function changePassword()
    {

        $user = auth()->user();

        return view('website.patient.profile.change_password', compact('user'));
    }

    public function myAppointment(ReservationRepository $reservationRepo)
    {

        $user = auth()->user();

        $reservations = $reservationRepo->findWhere(
            [
                'patient_id' => auth()->id(),
                'status' => $reservationRepo->getConstants()['STATUS_ACCEPTED'],
                'date' => [DB::raw('CONCAT(`date`,`from_time`)') , '>=', Carbon::now()]
            ]
        );
        return view('website.patient.profile.appointments', compact('user', 'reservations'));
    }
    public function myHistory(ReservationRepository $reservationRepo)
    {

        $user = auth()->user();

        $reservations = $reservationRepo->findWhere(
            [
                'patient_id' => auth()->id(),
       //         'status' => $reservationRepo->getConstants()['STATUS_ACCEPTED'],
                'date' => [DB::raw('CONCAT(`date`,`from_time`)') , '<=', Carbon::now()]
            ]
        );
        return view('website.patient.profile.histories', compact('user', 'reservations'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $rules = [
            'username' => 'nullable|string|max:191',
            'first_name' => 'nullable|string|max:191',
            'last_name' => 'nullable|string|max:191',
            'email' => 'nullable|email|unique:patients,email,' . auth()->id(),
            'phone' => 'nullable|numeric|unique:patients,phone,' . auth()->id(),
            'old_password' => ['required_with:password', 'nullable', 'string
            ', 'max:191', new CheckPassword('patients', auth()->user()->email)],
            'password' => 'nullable|string|max:191|confirmed',
            'civil_id' => 'nullable|numeric|unique:patients,civil_id,' . auth()->id(),
            'social_security_id' => 'nullable|integer|exists:social_securities,id',
            'birthdate' => 'nullable|date|date_format:Y-m-d',
            'district_id' => 'nullable|integer|exists:districts,id',
            'area_id' => 'nullable|integer|exists:areas,id',
            'gender' => 'nullable|integer|min:1|max:2',

        ];

        \Validator::make($request->all(), $rules)->validate();

        $patient = $this->repo->update(array_filter($request->all()), auth()->id());
        if ($request->image != null) {
            $image_data = $this->repo->saveFile($request->file('image'), 'patients');
            $patient->image()->updateOrCreate(['type' => $image_data['type']], $image_data);
        }
        toast(__("Updated Successfully"), 'success');
        return back();
    }

}
