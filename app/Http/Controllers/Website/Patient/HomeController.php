<?php

namespace App\Http\Controllers\Website\Patient;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{

    protected $redirectTo = '/patient/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('patient.auth:patient');
    }

    /**
     * Show the Patient dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        return view('website.patient.home');
    }

}
