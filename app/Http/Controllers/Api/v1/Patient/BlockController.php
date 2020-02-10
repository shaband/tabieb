<?php

namespace App\Http\Controllers\Api\v1\Patient;

use App\Http\Controllers\Controller;
use App\Repositories\interfaces\BlockRepository;
use Illuminate\Http\Request;

class BlockController extends Controller
{
    public $repo;

    public function __construct(BlockRepository $repo)
    {
        $this->repo = $repo;
    }


    public function index()
    {
        $blocks = $this->repo->all();
        return responseJson(['block' => $blocks]);
    }

    public function blocksInArea(Request $request)
    {
        $blocks = $this->repo->findByField('area_id', $request->area_id);
        return responseJson(['blocks' => $blocks], __("Loaded successfully"));
    }
}
