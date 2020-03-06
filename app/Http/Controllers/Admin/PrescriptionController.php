<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\MainController as Controller;
use App\Http\Requests\Admin\Prescriptions\PrescriptionRequest;
use App\Models\Reservation;
use App\Repositories\interfaces\PresciptionRepository;
use App\Repositories\interfaces\ReservationRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PrescriptionController extends Controller
{
    protected $repo;
    protected $routeName = '';
    protected $viewPath = 'admin.reservations.';

    protected $reservation_repo;

    public function __construct(PresciptionRepository $repo, ReservationRepository $reservation_repo)
    {
        $this->repo = $repo;

        $this->reservation_repo = $reservation_repo;
        parent::__construct($repo);
    }

    public function index($reservation_id)
    {

        $prescriptions = $this->repo->findWhere(['id' => $reservation_id]);
        return view('admin.prescriptions.index', compact('prescriptions'));
    }

    public function create($reservation_id)
    {
        $reservation = $this->reservation_repo->find($reservation_id);
        $prescription = $reservation->prescription;
        return view('admin.prescriptions.create', compact('prescription'));
    }

    public function store(PrescriptionRequest $request)
    {


        DB::beginTransaction();


        $reservation = $this->reservation_repo->updateStatus($request->reservation, Reservation::STATUS_FINISHED);

        $data = $this->handleRequest($request);

        $prescription = $this->repo->updateOrCreate
        (['reservation_id' => $data['reservation_id']], $data);

        $prescription->items()->delete();
        $items = $prescription->items()->createMany($request->items);
        DB::commit();

        return redirect()->route('admin.reservations.index');
    }


    /**
     * handle data from  request and generate at server on array to store it
     * @param $patient_id
     * @param Request $request
     * @return iterable
     */
    public function handleRequest(Request $request): array
    {

        $reservation = $this->reservation_repo->find($request->reservation);
        $data = [
            'code' => rand(00000, 99999),
            'patient_id' => $reservation->patient_id,
            'doctor_id' => $reservation->doctor_id,
            'reservation_id' => $request->reservation,
        ];

        $request_inputs = $request->only('diagnosis', 'description');
        $prescription = $data + $request_inputs;

        return $prescription;
    }
}
