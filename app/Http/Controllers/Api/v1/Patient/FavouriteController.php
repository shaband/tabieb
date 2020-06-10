<?php

namespace App\Http\Controllers\Api\v1\Patient;

use App\Http\Controllers\Controller;
use App\Http\Resources\Doctor\DoctorResource;
use App\Repositories\interfaces\FavouriteRepository;
use Illuminate\Http\Request;

class FavouriteController extends Controller
{

    public $repo;

    public function __construct(FavouriteRepository $repo)
    {
        $this->repo = $repo;
    }

    public function index()
    {

        return responseJson(
            [
                'doctors' => DoctorResource::collection(auth()->user()->favourites)
            ], __('Loaded Successfully'));

    }

    public function toggleFavourite(Request $request)
    {
        $this->validate($request, ['doctor_id' => 'required|integer|exists:doctors,id']);
        auth()->user()->favourites()->toggle([$request->doctor_id]);
        return responseJson(
            [
                'doctors' => DoctorResource::collection(auth()->user()->favourites)
            ], __("Updated Successfully"));

    }
}
