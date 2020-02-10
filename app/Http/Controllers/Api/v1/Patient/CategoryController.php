<?php

namespace App\Http\Controllers\Api\v1\Patient;


use App\Http\Resources\Category\CategoryResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\v1\CategoryController as Controller;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = $this->repo->all();

        return responseJson(['categories' => CategoryResource::collection($categories)], __("Loaded Successfully"));
    }
}
