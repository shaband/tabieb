<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\interfaces\AdminRepository;
use App\Repositories\SQL\BaseRepository;
use Illuminate\Http\Request;

abstract class MainController extends Controller
{

    private $repo;
    private $routeName;
    private $viewPath;

    //  abstract public function __construct(BaseRepository $repo);

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $model = $this->repo->find($id);
        return view($this->viewPath . 'show', compact('model'));


    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->repo->delete($id);
        toast(__("Deleted successfully"), 'success');

        return back();

    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function block($id, Request $request)
    {
        $model = $this->repo->block($request, $id);

        toast(__("Blocked successfully"), 'success');
        return back();
    }

}
