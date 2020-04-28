<?php

namespace App\Http\Controllers\Website\PharmacyRep;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{

    protected $redirectTo = '/pharmacy-rep/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('pharmacy_rep.auth:pharmacy_rep');
    }

    /**
     * Show the PharmacyRep dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('website.pharmacy_rep.prescriptions.search');
    }

}
