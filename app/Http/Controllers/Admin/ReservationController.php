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

        return view($this->viewPath . 'index', compact('reservations',));
    }


    public function create(DoctorRepository $doctorRepo, PatientRepository $patientRepo)
    {
        $doctors = $doctorRepo->Available();
        $patients = $patientRepo->findWhere(['blocked_at' => null]);

        return view($this->viewPath . 'create', compact('doctors', 'patients'));
    }

    /**
     * @param AdminRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ReservationRequest $request)
    {

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
        $doctors = $doctorRepo->Available();
        $patients = $patientRepo->findWhere(['blocked_at' => null]);


        return view($this->viewPath . 'edit', compact('reservation', 'doctors', 'patients'));
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
