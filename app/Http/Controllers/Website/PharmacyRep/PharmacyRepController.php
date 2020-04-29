<?php

namespace App\Http\Controllers\Website\PharmacyRep;

use App\Http\Controllers\Website\PharmacyRep\MainController as Controller;
use App\Http\Requests\Admin\PharmacyReps\PharmacyRepRequest;
use App\Repositories\interfaces\PharmacyRepRepository;


class PharmacyRepController extends Controller
{
    protected $repo;
    protected $routeName = 'pharmacy.pharmacy-reps.';
    protected $viewPath = 'website.pharmacy_rep.pharmacy_reps.';
    protected $roleName = "";

    public function __construct(PharmacyRepRepository $repo)
    {
        $this->repo = $repo;

        parent::__construct($repo, $this->roleName);

        $this->middleware('pharmacy.manger')->except('show', 'update');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $pharmacy_reps = $this->repo->findWhere(['pharmacy_id' => auth()->user()->pharmacy_id]);
        return view($this->viewPath . 'index', compact('pharmacy_reps'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {


        return view($this->viewPath . 'create', [
            'roles' => $this->repo::getConstantsFlipped('ROLE')
        ]);
    }

    /**
     * @param PharmacyRepRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PharmacyRepRequest $request)
    {
        $pharmacy_rep = $this->repo->store($request);
        toast(__("Added successfully"), 'success');

        return redirect()->route($this->routeName . 'index');
    }


    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        if (auth()->user()->role != 1 && auth()->id() != $id) {
            abort(404);
        }
        return view($this->viewPath . 'edit', [
            'pharmacy_rep' => $this->repo->find($id),
            'roles' => $this->repo::getConstantsFlipped('ROLE')
        ]);
    }

    /**
     * @param PharmacyRepRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PharmacyRepRequest $request, $id)
    {

        if (auth()->user()->role != 1 && auth()->id() != $id) {
            abort(404);
        }
        $pharmacy_rep = $this->repo->UpdatePharmacyRep($request, $id);

        toast(__("Updated successfully"), 'success');

        return redirect()->route($this->routeName . 'index');
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
}
