<?php

namespace App\Http\Controllers\Api\v1\Doctor;

use App\Http\Controllers\Controller;
use App\Http\Resources\Reservation\ReservationResource;
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
