<?php

namespace App\Http\Controllers\Api\v1\Doctor;

use App\Http\Controllers\Controller;
use App\Http\Resources\MedicalHistory\MedicalHistoryResource;
use App\Repositories\interfaces\MedicalHistoryRepository;
use Illuminate\Http\Request;

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

    public function index(Request $request)
    {
        $this->validate($request, ['patient_id' => 'required|integer|exists:patients,id']);

//        dd($this->repo->getMedicalHistoryForDoctor($request->patient_id));
        return responseJson([
            'medical_histories' => MedicalHistoryResource::collection($this->repo->getMedicalHistoryForDoctor($request->patient_id))
        ],
            __("Loaded Successfully"));
    }
}
