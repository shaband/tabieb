<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\MainController as Controller;
use App\Http\Requests\Admin\Admins\AdminRequest;
use App\Repositories\interfaces\AdminRepository;
use App\Repositories\interfaces\RoleRepository;


class AdminController extends Controller
{
    protected $repo;
    protected $routeName = 'admin.admins.';
    protected $viewPath = 'admin.admins.';
    protected $roleName = 'Admin';

    public function __construct(AdminRepository $repo)
    {
        $this->repo = $repo;
        parent::__construct($repo,$this->roleName);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $this->authorize('View Admin');
        $admins = $this->repo->all();

        return view($this->viewPath . 'index', compact('admins'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(RoleRepository $roleRepo)
    {
        $this->authorize('Create Admin');

        $roles = $roleRepo->all()->pluck('label', 'id');
        return view($this->viewPath . 'create', compact('roles'));
    }

    /**
     * @param AdminRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AdminRequest $request)
    {
        $this->authorize('Create Admin');

        $admin = $this->repo->store($request);
        toast(__("Added successfully"), 'success');

        return redirect()->route($this->routeName . 'index');
    }

    /**
     * @param $id
     * @param RoleRepository $roleRepo
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id, RoleRepository $roleRepo)
    {

        $this->authorize('Edit Admin');

        $roles = $roleRepo->all()->pluck('label', 'id');
        $admin = $this->repo->find($id);
        return view($this->viewPath . 'edit', compact('admin', 'roles'));
    }

    /**
     * @param AdminRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(AdminRequest $request, $id)
    {
        $this->authorize('Edit Admin');

        $admin = $this->repo->UpdateAdmin($request, $id);

        toast(__("Updated successfully"), 'success');

        return redirect()->route($this->routeName . 'index');
    }


}
