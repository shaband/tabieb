<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Admins\AdminRequest;
use App\Http\Requests\Admin\Doctors\DoctorRequest;
use App\Models\Doctor;
use App\Repositories\interfaces\CategoryRepository;
use App\Repositories\interfaces\DoctorRepository;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    private $repo;

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

        return view('admin.doctors.index', compact('open_doctors', 'blocked_doctors'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(CategoryRepository $categoryRepository)
    {

        $main_categories = $categoryRepository->cursor()->pluck('name', 'id');
        return view('admin.doctors.create', compact('main_categories'));
    }

    /**
     * @param AdminRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(DoctorRequest $request)
    {

        $doctor = $this->repo->store($request);
        toast(__("Added successfully"), 'success');

        return redirect()->route('admin.doctors.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        return view('admin.doctors.edit', compact('doctor', 'main_categories', 'sub_categories'));
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

        return redirect()->route('admin.doctors.index');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->repo->delete($id);
        toast(__("Updated successfully"), 'success');
        return back();
    }

    public function blockDoctor($id, Request $request)
    {
        $doctor = $this->repo->block($request, $id);
        toast(__("Updated successfully"), 'success');
        return back();
    }

}
