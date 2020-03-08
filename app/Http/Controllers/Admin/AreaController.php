<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\MainController as Controller;
use App\Http\Requests\Admin\Admins\AdminRequest;
use App\Http\Requests\Admin\areas\AreaRequest;
use App\Repositories\interfaces\AreaRepository;
use App\Repositories\interfaces\DistrictRepository;

class AreaController extends Controller
{
    protected $repo;

    protected $viewPath = 'admin.areas.';
    protected $routePath = 'admin.areas.';
    protected $roleName = 'Area';

    public function __construct(AreaRepository $repo)
    {
        $this->repo = $repo;

        parent::__construct($repo, $this->roleName);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $this->authorize('View ' . $this->roleName);

        $areas = $this->repo->all();

        return view($this->viewPath . 'index', compact('areas'));
    }

    /**
     * @param DistrictRepository $districtRepository
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(DistrictRepository $districtRepository)
    {
        $this->authorize('Create ' . $this->roleName);

        $districts = $districtRepository->all()->pluck('name', 'id');
        return view($this->viewPath . 'create', compact('districts'));
    }

    /**
     * @param AreaRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AreaRequest $request)
    {
        $this->authorize('Create ' . $this->roleName);

        $area = $this->repo->create($request->all());
        toast(__("Added successfully"), 'success');

        return redirect()->route($this->routeName . 'index');
    }


    /**
     * @param $id
     * @param DistrictRepository $districtRepository
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id, DistrictRepository $districtRepository)
    {
        $this->authorize('Edit ' . $this->roleName);

        $area = $this->repo->find($id);
        $districts = $districtRepository->all()->pluck('name', 'id');
        return view($this->viewPath . 'edit', compact('area', 'districts'));
    }

    /**
     * @param AreaRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(AreaRequest $request, $id)
    {
        $this->authorize('Edit ' . $this->roleName);

        $area = $this->repo->update($request->all(), $id);

        toast(__("Updated successfully"), 'success');

        return redirect()->route($this->routeName . 'index');
    }


}
