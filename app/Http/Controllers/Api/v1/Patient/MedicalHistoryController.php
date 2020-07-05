<?php

namespace App\Http\Controllers\Api\v1\Patient;

use App\Http\Controllers\Controller;
use App\Http\Requests\Website\MedicalHistoryRequest;
use App\Http\Resources\MedicalHistory\MedicalHistoryResource;
use App\Repositories\interfaces\MedicalHistoryRepository;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
        $medical_histories = $this->repo->query()
            ->with('image', 'creator')
            ->where('patient_id', $user->id)
            ->get();

        return responseJson(
            [
                'medical_histories' => MedicalHistoryResource::collection($medical_histories)
            ]
            , __("Loaded Successfully")
        );
    }

    public function store(MedicalHistoryRequest $request)
    {
        $inputs = $request->all();
        $inputs['creator_type'] = 'patients';

        $inputs['creator_id'] = $inputs['patient_id'] = auth()->id();
        $medical_history = $this->repo->store($inputs);
        return responseJson(
            [
                'medical_histories' => new  MedicalHistoryResource($medical_history)
            ],
            __("Loaded Successfully")
        );
    }

    public function update(MedicalHistoryRequest $request)
    {
        $this->validate($request, [
            'medical_history_id' => ['required', 'integer', Rule::exists('medical_histories', 'id')->where('creator_type', 'patients')
            ],
        ]);
        $inputs = $request->all();
        $medical_history = $this->repo->update($inputs, $request->medical_history_id);
        return responseJson(
            [
                'medical_histories' => new  MedicalHistoryResource($medical_history)
            ],
            __("Loaded Successfully")
        );
    }

    public function destroy(Request $request)
    {
        $this->validate($request, [
            'medical_history_id' => [
                'required', 'integer',
                Rule::exists('medical_histories', 'id')
                    ->where('creator_type', 'patients')
                    ->where('creator_id', auth()->id())
            ]]);
        $this->repo->delete($request->medical_history_id);
        return responseJson(null, __("Deleted Successfully"));
    }
}
