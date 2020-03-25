<?php

namespace App\Http\Controllers\Website\Doctor;

use App\Http\Controllers\Controller;
use App\Http\Resources\Reservation\ReservationResource;
use App\Models\Reservation;
use App\Repositories\interfaces\DoctorRepository;
use App\Repositories\interfaces\ReservationRepository;
use App\Rules\CheckPassword;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class DoctorController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public $repo;

    private $path;

    public function __construct(DoctorRepository $repo, $path = null)
    {

        auth()->setDefaultDriver('doctor_api');

        $this->repo = $repo;

        $this->path = $path ?? 'website.doctor.profile';

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit()
    {

        $user = auth()->user();

        return view('website.patient.profile.profile', compact('user'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function changePassword()
    {

        $user = auth()->user();

        return view($this->path . '.change_password', compact('user'));
    }

    /**
     * @param ReservationRepository $reservationRepo
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function myRequests(ReservationRepository $reservationRepo)
    {

        $user = auth()->user();

        $reservations = $reservationRepo->findWhere(
            [
                'doctor_id' => auth()->id(),
                'status' => $reservationRepo->getConstants()['STATUS_ACTIVE'],
                'date' => [DB::raw('CONCAT(`date`,`from_time`)'), '>=', Carbon::now()]
            ]
        );
        return view($this->path . '.requests', compact('user', 'reservations'));
    }

    /**
     * @param ReservationRepository $reservationRepo
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function myAppointment(ReservationRepository $reservationRepo)
    {

        $user = auth()->user();

        $reservations = $reservationRepo->findWhere(
            [
                'doctor_id' => auth()->id(),
                'status' => $reservationRepo->getConstants()['STATUS_ACCEPTED'],
                'date' => [DB::raw('CONCAT(`date`,`from_time`)'), '>=', Carbon::now()]
            ]
        );
        return view($this->path . '.appointments', compact('user', 'reservations'));
    }


    /**
     * @param ReservationRepository $reservationRepo
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function myHistory(ReservationRepository $reservationRepo)
    {

        $user = auth()->user();

        $reservations = $reservationRepo->findWhere(
            [
                'doctor_id' => auth()->id(),
                //         'status' => $reservationRepo->getConstants()['STATUS_ACCEPTED'],
                'date' => [DB::raw('CONCAT(`date`,`from_time`)'), '<=', Carbon::now()]
            ]
        );
        return view($this->path . '.histories', compact('user', 'reservations'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
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
            'old_password' => ['required_with:password', 'nullable', 'string
            ', 'max:191', new CheckPassword('doctors', auth()->user()->email)],
            'phone' => 'nullable|numeric|unique:doctors,phone,' . auth()->id(),
            'image' => 'nullable|image',
        ];

        \Validator::make($request->all(), $rules)->validate();

        $doctor = $this->repo->update(array_filter($request->all()), auth()->id());

        if ($request->image != null) {
            $image_data = $this->repo->saveFile($request->file('image'), 'doctors');
            $doctor->image()->updateOrCreate(['type' => $image_data['type']], $image_data);
        }

        toast(__("Updated Successfully"), 'success');

        return back();
    }


    /**
     *  change status for reservations
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function changeReservationStatus(Request $request)
    {
        $this->validate($request, [
            'reservation_id' => 'required|integer|exists:reservations,id,doctor_id,' . auth()->user()->id,
            'status' => ['required', 'integer',
                Rule::in(
                    [
                        Reservation::STATUS_ACCEPTED,
                        Reservation::STATUS_REFUSED,
                        Reservation::STATUS_CANCELED
                    ])],
        ]);
        $attributes = [
            'status' => $request->status,
            'status_changed_at' => Carbon::now(),
        ];
        $reservation = $this->repo->update($attributes, $request->reservation_id);

        $reservation = new ReservationResource($reservation->load('patient'));


        return responseJson(compact('reservation'), __('Updated Successfully'));
    }


}

