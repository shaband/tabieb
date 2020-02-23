<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\MainController as Controller;
use App\Http\Requests\Admin\Admins\AdminRequest;
use App\Http\Requests\Admin\Doctors\DoctorRequest;
use App\Models\Doctor;
use App\Repositories\interfaces\CategoryRepository;
use App\Repositories\interfaces\DoctorRepository;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    private $repo;
    private $routeName='admin.doctors.';
    private $viewPath='admin.doctors.';
    public function __construct(DoctorRepository $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $open_doctors = $this->repo->findWhere(['blocked_at' => null]);
        $blocked_doctors = $this->repo->findWhere([['blocked_at', '!=', null]]);

        return view($this->viewPath.'index', compact('open_doctors', 'blocked_doctors'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(CategoryRepository $categoryRepository)
    {

        $main_categories = $categoryRepository->cursor()->pluck('name', 'id');
        return view($this->viewPath.'create', compact('main_categories'));
    }

    /**
     * @param AdminRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(DoctorRequest $request)
    {

        $doctor = $this->repo->store($request);
        toast(__("Added successfully"), 'success');

        return redirect()->route($this->routeName.'index');
    }


    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id, CategoryRepository $categoryRepository)
    {
        $doctor = $this->repo->find($id);
        $main_categories = $categoryRepository->cursor()->pluck('name', 'id');
        $sub_categories = $categoryRepository->getSubCategoriesForMainCategory($doctor->category_id)->pluck('name', 'id');
        $doctor->sub_category_ids = $doctor->sub_categories->pluck('id');
        return view($this->viewPath.'edit', compact('doctor', 'main_categories', 'sub_categories'));
    }

    /**
     * @param AdminRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(DoctorRequest $request, $id)
    {
        $doctor = $this->repo->updateDoctor($request, $id);

        toast(__("Updated successfully"), 'success');

        return redirect()->route($this->routeName.'index');
    }


    public function blockDoctor($id, Request $request)
    {
        $doctor = $this->repo->block($request, $id);
        toast(__("Blocked successfully"), 'success');
        return back();
    }

}
