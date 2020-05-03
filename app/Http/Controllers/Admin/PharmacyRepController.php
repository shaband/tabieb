<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\MainController as Controller;
use App\Http\Requests\Admin\PharmacyReps\PharmacyRepRequest;
use App\Repositories\interfaces\PharmacyRepository;
use App\Repositories\interfaces\PharmacyRepRepository;


class PharmacyRepController extends Controller
{
    protected $repo;
    protected $routeName = 'admin.pharmacy-reps.';
    protected $viewPath = 'admin.pharmacy_reps.';
    protected $roleName = 'Pharmacyrep';

    public function __construct(PharmacyRepRepository $repo)
    {
        $this->repo = $repo;

        parent::__construct($repo, $this->roleName);

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index()
    {

        $this->authorize('View ' . $this->roleName);

        $pharmacy_reps = $this->repo->all();

        return view($this->viewPath . 'index', compact('pharmacy_reps'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create(PharmacyRepository $pharmacyRepo)
    {

        $this->authorize('Create ' . $this->roleName);

        return view($this->viewPath . 'create',
            [
                'pharmacies' => $pharmacyRepo->all()->pluck('name', 'id')
            ]);
    }

    /**
     * @param PharmacyRepRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(PharmacyRepRequest $request)
    {

        $this->authorize('Create ' . $this->roleName);

        $pharmacy_rep = $this->repo->store($request);
        toast(__("Added successfully"), 'success');

        return redirect()->route($this->routeName . 'index');
    }


    /**
     * @param $id
     * @param PharmacyRepository $pharmacyRepo
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit($id, PharmacyRepository $pharmacyRepo)
    {

        $this->authorize('Edit ' . $this->roleName);

        return view($this->viewPath . 'edit',
            [
                'pharmacies' => $pharmacyRepo->all()->pluck('name', 'id'),
                'pharmacy_rep' => $this->repo->find($id)
            ]);
    }

    /**
     * @param PharmacyRepRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(PharmacyRepRequest $request, $id)
    {

        $this->authorize('Edit ' . $this->roleName);

        $pharmacy_rep = $this->repo->UpdatePharmacyRep($request, $id);

        toast(__("Updated successfully"), 'success');

        return redirect()->route($this->routeName . 'index');
    }


}
