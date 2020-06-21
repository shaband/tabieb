<?php

namespace App\Http\Controllers\Website\Patient;

use App\Http\Controllers\Controller;
use App\Http\Resources\Doctor\DoctorResource;
use App\Models\Patient;
use App\Repositories\interfaces\CategoryRepository;
use App\Repositories\interfaces\FavouriteRepository;
use Illuminate\Http\Request;

class FavouriteController extends Controller
{

    public $repo;

    public function __construct(FavouriteRepository $repo)
    {
        $this->repo = $repo;
    }

    public function index(CategoryRepository $categoryRepo)
    {
        $categories = $categoryRepo->getMainCategory()->keyBy('id');

        $doctors = auth()->user()->favourites()->with('ratings:rate', 'category:name_ar,name_en,id', 'sub_categories:name_ar,name_en', 'schedules')->paginate(10);

        $doctors->each(function ($doctor) use ($categories, $categoryRepo) {
            $doctor->setRelation('category', $categories['category_id'] ?? $categoryRepo->query());
        });

        return view('website.search', compact('categories', 'doctors'));

    }

    public function toggleFavourite(Request $request, $doctor_id)
    {
        \Validator::make(['doctor_id' => $doctor_id], ['doctor_id' => 'required|integer|exists:doctors,id'])->validate();
        auth()->user()->favourites()->toggle([$doctor_id]);
        return responseJson(
            [
                'doctors' => DoctorResource::collection(auth()->user()->favourites)
            ], __("Updated Successfully"));

    }
}
