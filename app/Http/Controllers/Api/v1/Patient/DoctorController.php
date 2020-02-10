<?php

namespace App\Http\Controllers\Api\v1\Patient;

use App\Http\Controllers\Controller;
use App\Http\Resources\Doctor\doctorResource;
use App\Models\Doctor;
use App\Repositories\interfaces\DoctorRepository;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    private $repo;

    public function __construct(DoctorRepository $repo)
    {
        $this->repo = $repo;
    }


    public function index()
    {
        $popular_doctors = $this->repo->makeModel()->where('blocked_at', null)->limit(10)->get()->sortBy(function (Doctor $doctor) {
            return $doctor->reservation()->count();
        });

        $doctors_you_may_call = $this->repo->makeModel()
            ->where('blocked_at', null)
            ->whereNotIn('id', $popular_doctors->pluck('id'))
            ->get();

        $popular_doctors = doctorResource::collection($popular_doctors);
        $doctors_you_may_call = doctorResource::collection($doctors_you_may_call);
        return responseJson(compact('popular_doctors', 'doctors_you_may_call'), __("Loaded Successfully"));
    }

    public function doctorsInCategory(Request $request)
    {
        $doctors = $this->repo->makeModel()
            ->where('blocked_at', null)
            ->where('category_id', $request->category_id)
            ->get();
        $doctors = doctorResource::collection($doctors);
        return responseJson(compact('doctors'), __("Loaded Successfully"));
    }
}
