<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{

    protected $redirectTo = '/doctor/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('doctor.auth:doctor');
    }

    /**
     * Show the Doctor dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        return view('doctor.home');
    }

}
