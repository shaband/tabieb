<?php

namespace App\Http\Controllers\Api\v1\Patient;

use App\Http\Controllers\Controller;
use App\Repositories\interfaces\DistrictRepository;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    public $repo;

    public function __construct(DistrictRepository $repo)
    {
        $this->repo = $repo;
    }


    public function index()
    {
        $district = $this->repo->findWhere(['block_at'=>['blocked_at','!=',null]]);
        return responseJson(['district' => $district]);
    }
}
