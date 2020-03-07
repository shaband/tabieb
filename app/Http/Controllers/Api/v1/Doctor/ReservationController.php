<?php

namespace App\Http\Controllers\Api\v1\Doctor;

use App\Http\Controllers\Controller;
use App\Http\Resources\Reservation\ReservationResource;
use App\Models\Reservation;
use App\Repositories\interfaces\ReservationRepository;
use App\Repositories\interfaces\ScheduleRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class ReservationController extends Controller
{
    private $repo;

    public function __construct(ReservationRepository $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function upcoming(Request $request)
    {
        $reservation = $this->repo->makeModel()->where('doctor_id', auth()->id())
            ->whereDate('date', '>=', Carbon::now())
            ->whereIn('status', $this->repo::getConstants('STATUS_ACCEPTED'))->get();

        $reservation = ReservationResource::collection($reservation->load('patient'));

        return responseJson(compact('reservation'), __('Loaded Successfully'));
    }

    /**
     * get comming reservation by type
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ReservationsByType(Request $request)
    {


        $this->validate($request, [
            'status' => ['required', 'integer', Rule::in($this->repo::getConstants('STATUS'))]
        ]);
        $reservation = $this->repo->makeModel()->where('doctor_id', auth()->id())
            ->whereDate('date', '>=', Carbon::now())
            ->where('status', $request->status)->get();

        $reservation = ReservationResource::collection($reservation->load('patient'));

        return responseJson(compact('reservation'), __('Loaded Successfully'));
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

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function previous(Request $request)
    {
        $reservation = $this->repo->makeModel()
            ->whereDate('date', '<', Carbon::now())
            ->whereIn('status', $this->repo::getConstants('STATUS_ACCEPTED'))->get();
        $reservation = ReservationResource::collection($reservation);

        return responseJson(compact('reservation'), __('Loaded Successfully'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function reservation(Request $request)
    {
        $this->validate($request,
            [
                'reservation_id' => 'required|integer|exists:reservations,id,doctor_id,' . auth()->user()->id
            ]
        );
        $reservation = $this->repo->with('patient')->find($request->reservation_id);
        $reservation = new ReservationResource($reservation);
        return responseJson(compact('reservation'), __("Loaded successfully"));
    }

}