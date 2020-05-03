<?php

namespace App\Http\Controllers\Api\v1\Doctor;

use App\Http\Controllers\Controller;
use App\Http\Resources\Presciption\PrescriptionResource;
use App\Models\Reservation;
use App\Repositories\interfaces\PresciptionRepository;
use App\Repositories\interfaces\ReservationRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PrescriptionController extends Controller
{
    public $repo;

    public function __construct(PresciptionRepository $repo)
    {
        $this->repo = $repo;
    }

    /**
     * get prescription for reservation
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function index(Request $request)
    {

        $this->validate($request, [
            'reservation_id' => [
                'required', 'integer',
                'exists:prescriptions,reservation_id',
                'exists:reservations,id,doctor_id,' . auth()->id() . ',status,' . Reservation::STATUS_FINISHED,
            ],
        ]);

        $prescription = $this->repo->findByField('reservation_id', $request->reservation_id)->first();
        $prescription = new PrescriptionResource($prescription->load('patient', 'items', 'doctor'));

        return responseJson(compact('prescription'), __("Loaded Successfully"));
    }


    /**
     * get prescription for reservation
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function create(Request $request, ReservationRepository $reservationRepo)
    {

        $this->validate($request, [

            'reservation_id' => [
                'required', 'integer',
                'exists:reservations,id,doctor_id,' . auth()->id() . ',status,' . Reservation::STATUS_ACCEPTED,
            ],
            'diagnosis' => 'required|string|max:191',
            'description' => 'nullable',
            'items' => 'required|array',
            'items.*.medicine' => 'required|string|max:191',
            'items.*.dose' => 'required|string|max:191',
            'items.*.description' => 'nullable|string',
        ]);

        DB::beginTransaction();

        $reservation = $reservationRepo->updateStatus($request->reservation_id, Reservation::STATUS_FINISHED);

        $data = $this->handleRequest($reservation->patient_id, $request);

        $prescription = $this->repo->updateOrCreate(['reservation_id' => $request->reservation_id], $data);

        $prescription->items()->delete();
        $items = $prescription->items()->createMany($request->items);

        DB::commit();
        $prescription = new PrescriptionResource($prescription->fresh()->load('patient', 'items', 'doctor'));

        return responseJson(compact('prescription'), __("Saved Successfully"));
    }

    /**
     * handle data from  request and generate at server on array to store it
     * @param $patient_id
     * @param Request $request
     * @return iterable
     */
    public function handleRequest($patient_id, Request $request): array
    {
        $data = [
            'doctor_id' => auth()->id(),
            'code' => rand(00000, 99999),
            'patient_id' => $patient_id,
        ];
        $request_inputs = $request->only('reservation_id', 'diagnosis', 'description');
        $prescription = $data + $request_inputs;


        return $prescription;
    }
}
