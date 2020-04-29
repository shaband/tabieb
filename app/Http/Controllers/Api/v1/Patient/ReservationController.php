<?php

namespace App\Http\Controllers\Api\v1\Patient;

use App\Http\Controllers\Controller;
use App\Http\Resources\Reservation\ReservationResource;
use App\Repositories\interfaces\ReservationRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;


class ReservationController extends Controller
{
    private $repo;

    public function __construct(ReservationRepository $repo)
    {
        $this->repo = $repo;
    }

    public function create(Request $request)
    {

        $this->validate($request, [
            'doctor_id' => 'required|integer|exists:doctors,id',
            'date' => 'required|date|date_format:Y-m-d',
            'from_time' => ['required'],
            'to_time' => ['required'],
            'communication_type' => 'required|integer|min:1|max:2',
            'description' => 'nullable|string',
        ]);
        $reservation = $this->repo->store($request);
        $reservation = new ReservationResource($reservation);
        return responseJson(compact('reservation'), __("Saved Successfully"));
    }

    public function cancel(Request $request)
    {
        $this->validate($request,
            [
                'reservation_id' => 'required|integer|exists:reservations,id,patient_id,' . auth()->user()->id
            ]
        );

        $reservation = $this->repo->update(['canceled_at' => Carbon::now()], $request->reservation_id);

        $reservation = new ReservationResource($reservation);


        return responseJson(compact('reservation'), __('Canceled Successfully'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function upcoming(Request $request)
    {
        $reservation = $this->repo->query()->where('patient_id', auth()->id())
            ->whereDate('date', '>=', Carbon::now())
            ->with('doctor')
            ->whereIn('status', $this->repo::status())->get();

        $reservation = ReservationResource::collection($reservation);


        return responseJson(compact('reservation'), __('Loaded Successfully'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function previous(Request $request)
    {
        $reservation = $this->repo->query()
            ->with('doctor')

            ->whereDate('date', '<', Carbon::now())
            //   ->whereTime('from_time', '<', Carbon::now())
            ->get();

        $reservation = ReservationResource::collection($reservation);

        return responseJson(compact('reservation'), __('Loaded Successfully'));
    }


    public function reservation(Request $request)
    {
        $this->validate($request,
            [
                'reservation_id' => 'required|integer|exists:reservations,id,patient_id,' . auth()->user()->id
            ]
        );

        $reservation = $this->repo->with('doctor')->find($request->reservation_id);

        $reservation = new ReservationResource($reservation);

        return responseJson(compact('reservation'), __("Loaded successfully"));
    }

}
