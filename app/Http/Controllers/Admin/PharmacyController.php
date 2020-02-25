<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\MainController as Controller;
use App\Http\Requests\Admin\Admins\AdminRequest;
use App\Http\Requests\Admin\Pharmacy\PharmacyRequest;
use App\Repositories\interfaces\DistrictRepository;
use App\Repositories\interfaces\PharmacyRepository;
use App\Repositories\interfaces\SocialSecurityRepository;
use Illuminate\Http\Request;

class PharmacyController extends Controller
{
    protected $repo;
    protected $routeName = 'admin.pharmacies.';
    protected $viewPath = 'admin.pharmacies.';


    public function __construct(PharmacyRepository $repo)
    {
        $this->repo = $repo;
        parent::__construct($repo);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $open_pharmacies = $this->repo->findWhere(['blocked_at' => null]);
        $blocked_pharmacies = $this->repo->findWhere([['blocked_at', '!=', null]]);

        return view($this->viewPath . 'index', compact('open_pharmacies', 'blocked_pharmacies'));
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
    public function store(PharmacyRequest $request)
    {

        $pharmacy = $this->repo->store($request);
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
        $pharmacy = $this->repo->find($id);
        $districts = $districtRepo->cursor()->pluck('name', 'id');
        $areas = optional(optional($pharmacy->district)->areas)->pluck('name', 'id') ?? [];
        $blocks = optional(optional($pharmacy->area)->blocks)->pluck('name', 'id') ?? [];
        $social_securities = $securityRepo->cursor()->pluck('name', 'id');

        return view($this->viewPath . 'edit', compact('pharmacy', 'districts', 'social_securities', 'areas', 'blocks'));
    }

    /**
     * @param AdminRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PharmacyRequest $request, $id)
    {
        $pharmacy = $this->repo->updatePharmacy($request, $id);

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
