<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Admins\AdminRequest;
use App\Http\Requests\Admin\areas\AreaRequest;
use App\Repositories\interfaces\AreaRepository;
use App\Repositories\interfaces\DistrictRepository;

class AreaController extends Controller
{
    private $repo;

    public function __construct(AreaRepository $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {

        $areas = $this->repo->all();

        return view('admin.areas.index', compact('areas'));
    }

    /**
     * @param DistrictRepository $districtRepository
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(DistrictRepository $districtRepository)
    {
        $districts = $districtRepository->all()->pluck('name', 'id');
        return view('admin.areas.create', compact('districts'));
    }

    /**
     * @param AreaRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AreaRequest $request)
    {
        $area = $this->repo->create($request->all());
        toast(__("Added successfully"), 'success');

        return redirect()->route('admin.areas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * @param $id
     * @param DistrictRepository $districtRepository
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id, DistrictRepository $districtRepository)
    {
        $area = $this->repo->find($id);
        $districts = $districtRepository->all()->pluck('name', 'id');
        return view('admin.areas.edit', compact('area', 'districts'));
    }

    /**
     * @param AreaRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(AreaRequest $request, $id)
    {
        $area = $this->repo->update($request->all(), $id);

        toast(__("Updated successfully"), 'success');

        return redirect()->route('admin.areas.index');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->repo->delete($id);
        toast(__("Updated successfully"), 'success');

        return back();

    }
}
