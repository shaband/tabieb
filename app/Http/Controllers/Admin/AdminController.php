<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\MainController as Controller;
use App\Http\Requests\Admin\Admins\AdminRequest;
use App\Repositories\interfaces\AdminRepository;


class AdminController extends Controller
{
    protected $repo;
    protected $routeName = 'admin.admins.';
    protected $viewPath = 'admin.admins.';

    public function __construct(AdminRepository $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {

        $admins = $this->repo->all();

        return view($this->viewPath.'index', compact('admins'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {

        return view($this->viewPath.'create');
    }

    /**
     * @param AdminRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AdminRequest $request)
    {
        $admin = $this->repo->store($request);
        toast(__("Added successfully"), 'success');

        return redirect()->route($this->routeName.'index');
    }


    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $admin = $this->repo->find($id);
        return view($this->viewPath.'edit', compact('admin'));
    }

    /**
     * @param AdminRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(AdminRequest $request, $id)
    {
        $admin = $this->repo->UpdateAdmin($request, $id);

        toast(__("Updated successfully"), 'success');

        return redirect()->route($this->routeName.'index');
    }


}
