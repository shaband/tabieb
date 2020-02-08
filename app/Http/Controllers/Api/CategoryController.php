<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\interfaces\CategoryRepository;

class CategoryController extends Controller
{
    private $repo;

    public function __construct(CategoryRepository $repo)
    {
        $this->repo = $repo;
    }


    public function getSubCategoriesForMainCategory($category_id)
    {
        $sub_categories = $this->repo->getSubCategoriesForMainCategory($category_id);


        return responseJson($sub_categories);
    }
}
