<?php

namespace App\Http\Controllers\Website\Doctor;

use App\Events\NotifyUser;
use App\Http\Controllers\Controller;
use App\Http\Resources\Presciption\PrescriptionResource;
use App\Models\Reservation;
use App\Notifications\PrescriptionAdded;
use App\Repositories\interfaces\PresciptionRepository;
use App\Repositories\interfaces\ReservationRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
     * open prescription form
     * @param $reservation_id
     */
    public function create($reservation_id)
    {
        Validator::make(['reservation_id' => $reservation_id], ['reservation_id' => 'required|integer|exists:reservations,id,doctor_id,' . auth()->id()])->validate();

        return view(
            'website.doctor.prescriptions.create',
            ['prescription' => $this->repo->firstOrNew(['doctor_id' => auth()->id(), 'reservation_id' => $reservation_id])]
        );
    }

    /**
     * add prescription for reservation
     * @param Request $request
     * @param ReservationRepository $reservationRepo
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request, ReservationRepository $reservationRepo)
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
         $prescription->items()->createMany($request->items);
        $user = $prescription->patient;
        $user->notify(new PrescriptionAdded($prescription));
        // event(new NotifyUser($reservation->patient, 'patient', 'notification', $prescription));
        DB::commit();

        toast(__("Saved Successfully"), 'success');
        return redirect()->route('home');
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
