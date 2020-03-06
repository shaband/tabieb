<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\MainController as Controller;
use App\Http\Requests\Admin\Admins\AdminRequest;
use App\Http\Requests\Admin\Reservations\ReservationRequest;
use App\Repositories\interfaces\DoctorRepository;
use App\Repositories\interfaces\PatientRepository;
use App\Repositories\interfaces\ReservationRepository;
use App\Repositories\interfaces\ScheduleRepository;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    protected $repo;
    protected $routeName = 'admin.reservations.';
    protected $viewPath = 'admin.reservations.';


    public function __construct(ReservationRepository $repo)
    {
        $this->repo = $repo;
        parent::__construct($repo);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $reservations = $this->repo->orderBy('created_at', 'desc')->all();

        $active_reservations = $this->repo->orderBy('created_at', 'desc')->findByField('status', $this->repo::getConstants()['STATUS_ACTIVE']);

        $accepted_reservations = $this->repo->orderBy('created_at', 'desc')->findByField('status', $this->repo::getConstants()['STATUS_ACCEPTED']);

        $refused_reservations = $this->repo->orderBy('created_at', 'desc')->findByField('status', $this->repo::getConstants()['STATUS_REFUSED']);

        $canceled_reservations = $this->repo->orderBy('created_at', 'desc')->findByField('status', $this->repo::getConstants()['STATUS_CANCELED']);

        $finished_reservations = $this->repo->orderBy('created_at', 'desc')->findByField('status', $this->repo::getConstants()['STATUS_FINISHED']);

        return view($this->viewPath . 'index', compact('reservations', 'accepted_reservations', 'refused_reservations', 'canceled_reservations', 'finished_reservations', 'active_reservations'));
    }


    public function create(DoctorRepository $doctorRepo, PatientRepository $patientRepo)
    {
        $doctors = $doctorRepo->Available()->pluck('name', 'id');
        $patients = $patientRepo->findWhere(['blocked_at' => null])->pluck('name', 'id');
        $communication_types = $this->repo::getConstants('COMMUNICATION');
        return view($this->viewPath . 'create', compact('doctors', 'patients', 'communication_types'));
    }

    /**
     * @param AdminRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ReservationRequest $request)
    {

        //  dd($request->all());
        $reservation = $this->repo->store($request);
        toast(__("Added successfully"), 'success');
        return redirect()->route($this->routeName . 'index');
    }

    /**
     * @param $id
     * @param DoctorRepository $doctorRepo
     * @param ScheduleRepository $scheduleRepo
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id, DoctorRepository $doctorRepo, ScheduleRepository $scheduleRepo, PatientRepository $patientRepo)
    {
        $reservation = $this->repo->find($id);
        $doctors = $doctorRepo->Available()->pluck('name', 'id');
        $patients = $patientRepo->findWhere(['blocked_at' => null])->pluck('name', 'id');
        $communication_types = $this->repo::getConstants('COMMUNICATION');


        return view($this->viewPath . 'edit', compact('reservation', 'doctors', 'patients', 'communication_types'));
    }

    /**
     * @param AdminRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ReservationRequest $request, $id)
    {
        $reservation = $this->repo->updateReservation($request, $id);
        toast(__("Updated successfully"), 'success');
        return redirect()->route($this->routeName . 'index');
    }
}
