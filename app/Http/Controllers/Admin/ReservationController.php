<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\MainController as Controller;
use App\Http\Requests\Admin\Admins\AdminRequest;
use App\Http\Requests\Admin\Reservations\ReservationRequest;
use App\Repositories\interfaces\DoctorRepository;
use App\Repositories\interfaces\ReservationRepository;
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


    public function create(DoctorRepository $doctorRepo)
    {
        $doctors=$doctorRepo;
        return view($this->viewPath . 'create', compact('districts', 'social_securities'));
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
     * @param SocialSecurityRepository $securityRepo
     * @param DistrictRepository $districtRepo
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id, SocialSecurityRepository $securityRepo, DistrictRepository $districtRepo)
    {
        $reservation = $this->repo->find($id);
        $districts = $districtRepo->cursor()->pluck('name', 'id');
        $areas = optional(optional($reservation->district)->areas)->pluck('name', 'id') ?? [];
        $blocks = optional(optional($reservation->area)->blocks)->pluck('name', 'id') ?? [];
        $social_securities = $securityRepo->cursor()->pluck('name', 'id');

        return view($this->viewPath . 'edit', compact('reservation', 'districts', 'social_securities', 'areas', 'blocks'));
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


    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function block($id, Request $request)
    {
        $model = $this->repo->block($request, $id);

        toast(__("Blocked successfully"), 'success');
        return back();
    }
}
