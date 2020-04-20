<?php

namespace App\Http\Controllers\Website\Patient;

use App\Http\Controllers\Controller;
use App\Http\Requests\Website\MedicalHistoryRequest;
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

    public function index()
    {
        $user = auth()->user();
        $medical_histories = $this->repo->with(['image:file', 'creator'])->findByField('patient_id', $user->id);

        return view('website.patient.profile.medical_histories', compact('user', 'medical_histories'));
    }

    public function store(MedicalHistoryRequest $request)
    {

        $inputs = $request->all();

        $inputs['creator_type'] = 'patients';
        $inputs['creator_id'] = auth()->id();
        $this->repo->store($inputs);

        toast(__("Saved Successfully"), 'success');
        return back();
    }
}
