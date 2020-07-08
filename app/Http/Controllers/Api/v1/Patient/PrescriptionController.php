<?php

namespace App\Http\Controllers\Api\v1\Patient;

use App\Http\Controllers\Controller;
use App\Http\Resources\Presciption\PrescriptionResource;
use App\Repositories\interfaces\PresciptionRepository;
use Illuminate\Http\Request;

class PrescriptionController extends Controller
{
    public $repo;

    public function __construct(PresciptionRepository $repo)
    {
        $this->repo = $repo;
    }

    public function index()
    {
        $prescriptions = $this->repo->findByField('patient_id', auth()->id());
        return responseJson([
            'prescription' => PrescriptionResource::collection($prescriptions)
        ], __("Loaded Successfully"));


    }

    public function show(Request $request)
    {

        $this->validate($request, [
            'reservation_id' => ['required', 'integer',
                'exists:reservations,id,patient_id,' . auth()->id(),
                'exists:prescriptions,reservation_id,patient_id,' . auth()->id()
            ]
        ]);
        $prescription = $this->repo->where('reservation_id', $request->reservation_id)->first();

        $prescription = new PrescriptionResource($prescription->load('doctor', 'items'));

        return responseJson(compact('prescription'), __("Loaded Successfully"));
    }
}
