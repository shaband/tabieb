<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Repositories\interfaces\SocialSecurityRepository;
use Illuminate\Http\Request;

class SocialSecurityController extends Controller
{
    public $repo;

    public function __construct(SocialSecurityRepository $repo)
    {
        $this->repo = $repo;
    }

    public function index()
    {
        $social_security = $this->repo->all();
        return responseJson(['social_security' => $social_security]);
    }

}
