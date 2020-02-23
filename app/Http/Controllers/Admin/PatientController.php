<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\MainController as Controller;
use App\Http\Requests\Admin\Admins\AdminRequest;
use App\Http\Requests\Admin\Patient\PatientRequest;
use App\Repositories\interfaces\DistrictRepository;
use App\Repositories\interfaces\PatientRepository;
use App\Repositories\interfaces\SocialSecurityRepository;
use Illuminate\Http\Request;

class PatientController extends Controller
{

    private $repo;
    private $routeName = 'admin.patients.';
    private $viewPath = 'admin.patients.';


    public function __construct(PatientRepository $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $open_patients = $this->repo->findWhere(['blocked_at' => null]);
        $blocked_patients = $this->repo->findWhere([['blocked_at', '!=', null]]);

        return view($this->viewPath . 'index', compact('open_patients', 'blocked_patients'));
    }

    /**
     * @param SocialSecurityRepository $securityRepo
     * @param DistrictRepository $districtRepo
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(SocialSecurityRepository $securityRepo, DistrictRepository $districtRepo)
    {
        $districts = $districtRepo->cursor()->pluck('name', 'id');

        $social_securities = $securityRepo->cursor()->pluck('name', 'id');
        return view($this->viewPath . 'create', compact('districts', 'social_securities'));
    }

    /**
     * @param AdminRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PatientRequest $request)
    {

        $patient = $this->repo->store($request);
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
        $patient = $this->repo->find($id);
        $districts = $districtRepo->cursor()->pluck('name', 'id');
        $areas = optional(optional($patient->district)->areas)->pluck('name', 'id') ?? [];
        $blocks = optional(optional($patient->area)->blocks)->pluck('name', 'id') ?? [];
        $social_securities = $securityRepo->cursor()->pluck('name', 'id');

        return view($this->viewPath . 'edit', compact('patient', 'districts', 'social_securities', 'areas', 'blocks'));
    }

    /**
     * @param AdminRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PatientRequest $request, $id)
    {
        $patient = $this->repo->updatePatient($request, $id);

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
