<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Admins\AdminRequest;
use App\Http\Requests\Admin\Blocks\BlockRequest;
use App\Repositories\interfaces\AreaRepository;
use App\Repositories\interfaces\BlockRepository;
use Illuminate\Http\Request;

class BlockController extends Controller
{
    protected $repo;

    protected $roleName = 'Area';

    public function __construct(BlockRepository $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {

        $this->authorize('View ' . $this->roleName);
        $blocks = $this->repo->all();

        return view('admin.blocks.index', compact('blocks'));
    }

    /**
     * @param AreaRepository $areaRepository
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(AreaRepository $areaRepository)
    {
        $this->authorize('Create ' . $this->roleName);

        $areas = $areaRepository->all()->pluck('name', 'id');

        return view('admin.blocks.create', compact('areas'));
    }

    /**
     * @param BlockRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(BlockRequest $request)
    {
        $this->authorize('Create ' . $this->roleName);

        $block = $this->repo->create($request->all());
        toast(__("Added successfully"), 'success');

        return redirect()->route('admin.blocks.index');
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

    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id, AreaRepository $areaRepository)
    {
        $this->authorize('Edit ' . $this->roleName);

        $block = $this->repo->find($id);
        $areas = $areaRepository->all()->pluck('name', 'id');
        return view('admin.blocks.edit', compact('block', 'areas'));
    }

    /**
     * @param AdminRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(BlockRequest $request, $id)
    {
        $this->authorize('Edit ' . $this->roleName);

        $block = $this->repo->update($request->all(), $id);

        toast(__("Updated successfully"), 'success');

        return redirect()->route('admin.blocks.index');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->authorize('Delete ' . $this->roleName);

        $this->repo->delete($id);
        toast(__("Deleted successfully"), 'success');

        return back();

    }
}
