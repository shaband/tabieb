<?php

namespace App\Http\Controllers\Api\v1\Patient;

use App\Http\Controllers\Controller;
use App\Http\Resources\Rating\RatingResource;
use App\Repositories\interfaces\RatingRepository;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public $repo;

    public function __construct(RatingRepository $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function create(Request $request)
    {
        $this->validate($request, [
            'reservation_id' => 'required|integer|exists:reservations,id,patient_id,' . auth()->user()->id,
            'description' => 'nullable|string',
            'rate' => 'required|integer|min:0|max:5'
        ]);
        $rate = $this->repo->store($request)->fresh()->load('patient');
        $rate = new RatingResource($rate);
        return responseJson(compact('rate'), __("Rated Successfully"));
    }
}
