<?php

namespace App\Http\Controllers\Website\Patient;

use App\Http\Controllers\Controller;
use App\Http\Resources\Presciption\PrescriptionResource;
use App\Models\Reservation;
use App\Repositories\interfaces\PresciptionRepository;
use App\Repositories\interfaces\ReservationRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PrescriptionController extends Controller
{
    public $repo;
    public $reservation_repo;

    public function __construct(PresciptionRepository $repo, ReservationRepository $reservation_repo)
    {
        $this->repo = $repo;
        $this->reservation_repo = $reservation_repo;
    }

    /**
     * get prescription for reservation
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function index(Request $request)
    {



        $prescription = $this->repo->findByField('patient_id',auth()->id())->with('patient', 'items', 'doctor')->get();

        return responseJson(compact('prescription'), __("Loaded Successfully"));
    }


    public function show($reservation_id)
    {


        Validator::make(['reservation_id' => $reservation_id], [
            'reservation_id' => [
                'required', 'integer',
                'exists:prescriptions,reservation_id',
                'exists:reservations,id,status,' . Reservation::STATUS_FINISHED,
            ],
        ])->validate();


        $prescription = $this->repo->with(['patient', 'items', 'doctor'])->findByField('reservation_id', $reservation_id)->first();

        return view(
            'website.doctor.prescriptions.show',
            [
                'prescription' => $prescription
            ]
        );
    }

}
