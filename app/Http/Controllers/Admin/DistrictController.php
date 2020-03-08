<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Admins\AdminRequest;
use App\Http\Requests\Admin\Districts\DistrictRequest;
use App\Repositories\interfaces\DistrictRepository;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    protected $repo;
    protected $roleName='District';

    public function __construct(DistrictRepository $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {

        $this->authorize('View ' . $this->roleName);

        $open_districts = $this->repo->findWhere(['blocked_at' => null]);
        $blocked_districts = $this->repo->findWhere([['blocked_at', '!=', null]]);

        return view('admin.districts.index', compact('open_districts', 'blocked_districts'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $this->authorize('Create ' . $this->roleName);

        return view('admin.districts.create');
    }

    /**
     * @param AdminRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(DistrictRequest $request)
    {
        $this->authorize('Create ' . $this->roleName);

        $district = $this->repo->create($request->all());
        toast(__("Added successfully"), 'success');

        return redirect()->route('admin.districts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorize('View ' . $this->roleName);

        //
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $this->authorize('Edit ' . $this->roleName);

        $district = $this->repo->find($id);
        return view('admin.districts.edit', compact('district'));
    }

    /**
     * @param AdminRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(DistrictRequest $request, $id)
    {
        $this->authorize('Edit ' . $this->roleName);

        $district = $this->repo->update($request->all(), $id);

        toast(__("Updated successfully"), 'success');

        return redirect()->route('admin.districts.index');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->authorize('Delete ' . $this->roleName);

        $this->repo->delete($id);
        toast(__("Updated successfully"), 'success');
        return back();
    }

    public function blockDistrict($id, Request $request)
    {

        $this->authorize('Edit ' . $this->roleName);

        $district = $this->repo->block($request, $id);
        toast(__("Deleted successfully"), 'success');
        return back();

    }
}
