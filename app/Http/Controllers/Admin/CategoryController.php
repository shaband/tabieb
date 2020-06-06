<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\categories\CategoryRequest;
use App\Repositories\interfaces\CategoryRepository;

class CategoryController extends Controller
{
    protected $repo;
    protected $roleName = 'Category';

    public function __construct(CategoryRepository $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $this->authorize('View ' . $this->roleName);

        $categories = $this->repo->main()->paginate(10);
        $sub_categories = $this->repo->sub()->paginate(10);

        return view('admin.categories.index', compact('categories', 'sub_categories'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $this->authorize('Create ' . $this->roleName);

        $main_categories = $this->repo->getMainCategory()->pluck('name', 'id');
        return view('admin.categories.create', compact('main_categories'));
    }

    /**
     * @param CategoryRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CategoryRequest $request)
    {
        $this->authorize('Create ' . $this->roleName);

        $this->repo->create($request->all());
        toast(__("Added successfully"), 'success');

        return redirect()->route('admin.categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorize('View ' . $this->roleName);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $this->authorize('Edit ' . $this->roleName);

        $category = $this->repo->find($id);

        $main_categories = $this->repo->getMainCategory()->pluck('name', 'id');

        return view('admin.categories.edit', compact('category', 'main_categories'));
    }

    /**
     * @param CategoryRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CategoryRequest $request, $id)
    {
        $this->authorize('Edit ' . $this->roleName);

        $this->repo->update($request->all(), $id);

        toast(__("Updated successfully"), 'success');

        return redirect()->route('admin.categories.index');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->authorize('Delete ' . $this->roleName);


        $this->repo->delete($id);
        toast(__("Deleted successfully"), 'success');

        return back();
    }
}
