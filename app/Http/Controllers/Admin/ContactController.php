<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\MainController;
use App\Http\Requests\Admin\Admins\AdminRequest;
use App\Http\Requests\Admin\Contact\ContactRequest;
use App\Repositories\interfaces\DistrictRepository;
use App\Repositories\interfaces\ContactRepository;
use App\Repositories\interfaces\SocialSecurityRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ContactController extends MainController
{

    protected $repo;
    protected $routeName = 'admin.contacts.';
    protected $viewPath = 'admin.contacts.';
    protected $roleName='Contact';


    public function __construct(ContactRepository $repo)
    {
        $this->repo = $repo;
        parent::__construct($repo,$this->roleName);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $this->authorize('View ' . $this->roleName);

        $this->repo->where('seen_at', null)->update(['seen_at' => Carbon::now(), 'seen_by' => auth()->id()]);
        $contacts = $this->repo->orderBy('seen_at', 'desc')->all();


        return view($this->viewPath . 'index', compact('contacts'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $this->authorize('Edit ' . $this->roleName);

        $contact = $this->repo->find($id);

        return view($this->viewPath . 'edit', compact('contact'));
    }

    /**
     * @param ContactRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ContactRequest $request, $id)
    {
        $this->authorize('Edit ' . $this->roleName);

        $contact = $this->repo->update($request->all(), $id);

        toast(__("Updated successfully"), 'success');

        return redirect()->route($this->routeName . 'index');
    }


}
