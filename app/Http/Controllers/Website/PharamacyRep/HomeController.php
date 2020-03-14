<?php

namespace App\Http\Controllers\Website\PharamacyRep;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{

    protected $redirectTo = '/pharamacyrep/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('pharamacy_rep.auth:pharamacy_rep');
    }

    /**
     * Show the PharamacyRep dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        return view('website.pharamacyrep.home');
    }

}
