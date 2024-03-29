<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Admins\AdminRequest;
use App\Http\Requests\Admin\Schedules\ScheduleRequest;
use App\Repositories\interfaces\DoctorRepository;
use App\Repositories\interfaces\ScheduleRepository;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    protected $repo;
    protected $roleName = 'Schedule';

    public function __construct(ScheduleRepository $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $this->authorize('View ' . $this->roleName);

        $schedules = $this->repo->all();

        return view('admin.schedules.index', compact('schedules'));
    }

    /**
     * @param DoctorRepository $doctorRepository
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(DoctorRepository $doctorRepository)
    {

        $this->authorize('Create '.$this->roleName);

        $doctors = $doctorRepository->cursor()->pluck('name', 'id');

        return view('admin.schedules.create', compact('doctors'));
    }

    /**
     * @param ScheduleRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ScheduleRequest $request)
    {
        $this->authorize('Create '.$this->roleName);

        $schedule = $this->repo->create($request->all());
        toast(__("Added successfully"), 'success');

        return redirect()->route('admin.schedules.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $this->authorize('View '.$this->roleName);


    }

    /**
     * @param $id
     * @param DoctorRepository $doctorRepository
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id, DoctorRepository $doctorRepository)
    {

        $this->authorize('Edit '.$this->roleName);

        $schedule = $this->repo->find($id);
        $doctors = $doctorRepository->all()->pluck('name', 'id');
        return view('admin.schedules.edit', compact('schedule', 'doctors'));
    }

    /**
     * @param AdminRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ScheduleRequest $request, $id)
    {

        $this->authorize('Edit '.$this->roleName);

        $schedule = $this->repo->update($request->all(), $id);

        toast(__("Updated successfully"), 'success');

        return redirect()->route('admin.schedules.index');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {

        $this->authorize('Delete '.$this->roleName);

        $this->repo->delete($id);
        toast(__("Deleted successfully"), 'success');

        return back();

    }
}
