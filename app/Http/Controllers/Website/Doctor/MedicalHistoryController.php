<?php

namespace App\Http\Controllers\Website\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Repositories\interfaces\MedicalHistoryRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MedicalHistoryController extends Controller
{

    protected $repo;

    /**
     * MedicalHistoryController constructor.
     * @param MedicalHistoryRepository $repo
     */
    public function __construct(MedicalHistoryRepository $repo)
    {
        $this->repo = $repo;
    }

    public function index($patient_id)
    {

        return view('website.medical_history', [
            'medical_histories' => $this->repo->getMedicalHistoryForDoctor($patient_id)
        ]);
    }
}
