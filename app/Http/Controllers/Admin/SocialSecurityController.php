<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SocialSecurities\SocialSecurityRequest;
use App\Repositories\interfaces\SocialSecurityRepository;

class SocialSecurityController extends Controller
{
    protected $repo;
    protected $roleName = 'Socialsecurity';

    public function __construct(SocialSecurityRepository $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {

        $this->authorize('View ' . $this->roleName);

        $social_securities = $this->repo->all();

        return view('admin.social_securities.index', compact('social_securities'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $this->authorize('Create ' . $this->roleName);

        return view('admin.social_securities.create');
    }

    /**
     * @param SocialSecurityRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(SocialSecurityRequest $request)
    {
        $this->authorize('Create ' . $this->roleName);

        $social_security = $this->repo->create($request->all());
        toast(__("Added successfully"), 'success');

        return redirect()->route('admin.social-securities.index');
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

        $social_security = $this->repo->find($id);
        return view('admin.social_securities.edit', compact('social_security'));
    }

    /**
     * @param SocialSecurityRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(SocialSecurityRequest $request, $id)
    {
        $this->authorize('Edit ' . $this->roleName);

        $social_security = $this->repo->update($request->all(), $id);

        toast(__("Updated successfully"), 'success');

        return redirect()->route('admin.social-securities.index');
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
