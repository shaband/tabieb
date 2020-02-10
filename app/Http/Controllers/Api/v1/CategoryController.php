<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Repositories\interfaces\CategoryRepository;

class CategoryController extends Controller
{
    public $repo;

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
