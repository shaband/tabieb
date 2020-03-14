<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Http\Resources\Doctor\DoctorResource;
use App\Models\Doctor;
use App\Repositories\interfaces\CategoryRepository;
use App\Repositories\interfaces\DoctorRepository;


class HomeController extends Controller
{

    protected $doctor_repo;
    protected $category_repo;

    public function __construct(DoctorRepository $doctor_repo, CategoryRepository $categoryRepo)
    {
        $this->doctor_repo = $doctor_repo;
        $this->category_repo = $categoryRepo;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $doctors = $this->doctor_repo->makeModel()->where('blocked_at', null)->limit(4)->get()->sortBy(function (Doctor $doctor) {
            return $doctor->reservation()->count();
        });

        $categories =$this->category_repo->getMainCategory()->pluck('name', 'id');

        return view('website.index', compact('doctors','categories'));
    }
}
