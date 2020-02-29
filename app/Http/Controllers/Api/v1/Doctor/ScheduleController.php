<?php

namespace App\Http\Controllers\Api\v1\Doctor;

use App\Http\Controllers\Controller;
use App\Http\Resources\Schedule\ScheduleResource;
use App\Repositories\interfaces\ScheduleRepository;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public $repo;

    public function __construct(ScheduleRepository $repo)
    {
        $this->repo = $repo;
    }

    public function index()
    {
        $schedules = $this->repo->findByField('doctor_id', auth()->id());
        $schedules = ScheduleResource::collection($schedules);
        return responseJson(compact('schedules'), __("Loaded Successfully"));
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'day' => 'required|integer|min:1|max:7',
            'from_time' => 'required|date_format:H:i',
            'to_time' => 'required|date_format:H:i',
        ]);

        $inputs = $request->all();
        $inputs['doctor_id'] = auth()->id();
        $schedule = $this->repo->create($inputs);
        $schedule = new ScheduleResource($schedule);
        return responseJson(compact('schedule'), __("Saved Successfully"));
    }

    public function edit(Request $request)
    {
        $this->validate($request, [
            'schedule_id' => 'required|integer|exists:schedules,id,doctor_id,' . auth()->id(),
            'day' => 'required|integer|min:1|max:7',
            'from_time' => 'required|date_format:H:i',
            'to_time' => 'required|date_format:H:i',
        ]);
        $inputs = $request->all();
        $schedule = $this->repo->update($inputs, $request->schedule_id);
        $schedule = new ScheduleResource($schedule);
        return responseJson(compact('schedule'), __("Saved Successfully"));
    }


    public function delete(Request $request)
    {
        $this->validate($request, [
            'schedule_id' => 'required|integer|exists:schedules,id,doctor_id,' . auth()->id(),
        ]);
        $this->repo->delete($request->schedule_id);
        return responseJson(['schedule' => null], __("deleted Successfully"));
    }


}
