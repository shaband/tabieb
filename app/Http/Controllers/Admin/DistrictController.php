<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Admins\AdminRequest;
use App\Http\Requests\Admin\Districts\DistrictRequest;
use App\Repositories\interfaces\DistrictRepository;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    private $repo;

    public function __construct(DistrictRepository $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {

        $open_districts = $this->repo->findWhere(['blocked_at' => null]);
        $blocked_districts = $this->repo->findWhere([['blocked_at', '!=', null]]);

        return view('admin.districts.index', compact('open_districts', 'blocked_districts'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {

        return view('admin.districts.create');
    }

    /**
     * @param AdminRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(DistrictRequest $request)
    {
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
        //
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
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
        $this->repo->delete($id);
        toast(__("Updated successfully"), 'success');
        return back();
    }

    public function blockDistrict($id, Request $request)
    {

        $district = $this->repo->block($request, $id);
        toast(__("Deleted successfully"), 'success');
        return back();

    }
}
