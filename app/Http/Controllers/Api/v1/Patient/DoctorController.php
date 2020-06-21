<?php

namespace App\Http\Controllers\Api\v1\Patient;

use App\Http\Controllers\Controller;
use App\Http\Resources\Doctor\DoctorResource;
use App\Models\Doctor;
use App\Repositories\interfaces\DoctorRepository;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    private $repo;

    /**
     * DoctorController constructor.
     * @param DoctorRepository $repo
     */
    public function __construct(DoctorRepository $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {

        $popular_doctors = $this->repo->MobileDoctor()
            ->withCount('reservation')
            ->get()
            ->sortBy(function (Doctor $doctor) {
                return $doctor->reservation_count;
            });

        $doctors_you_may_call = $this->repo->MobileDoctor()
            ->whereNotIn('id', $popular_doctors->pluck('id'))
            ->get();

        return responseJson([
            'popular_doctors' => DoctorResource::collection($popular_doctors),
            'doctors_you_may_call' => DoctorResource::collection($doctors_you_may_call)
        ], __("Loaded Successfully"));
    }

    public function show()
    {
        return responseJson([
            'doctor' => new DoctorResource ($this->repo->with([])->find('id'))
        ], __("Loaded Successfully"));;


    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function doctorsInCategory(Request $request)
    {
        return responseJson(
            [
                'doctors' => DoctorResource::collection($this->repo->doctorsInCategory($request))
            ],
            __("Loaded Successfully"));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(Request $request)
    {
        return responseJson(
            [
                'doctors' => DoctorResource::collection($this->repo->searchInDoctors($request))
            ],
            __("Loaded Successfully"));
    }




}
