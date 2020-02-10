<?php

namespace App\Http\Controllers\Api\v1\Patient;

use App\Http\Controllers\Controller;
use App\Repositories\interfaces\AreaRepository;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    public $repo;

    public function __construct(AreaRepository $repo)
    {
        $this->repo = $repo;
    }

    public function index()
    {
        $areas = $this->repo->all();
        return responseJson(['ares' => $areas]);
    }

    public function areasInDistrict(Request $request)
    {
        $areas = $this->repo->findWhere(['district_id' => $request->district_id]);
        return responseJson(['areas' => $areas], __("Loaded successfully"));
    }
}
