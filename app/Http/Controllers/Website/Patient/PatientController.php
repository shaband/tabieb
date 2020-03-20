<?php

namespace App\Http\Controllers\Website\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function edit()
    {

        $user = auth()->user();

        return view('website.patient.profile.profile', compact('user'));
    }
}
