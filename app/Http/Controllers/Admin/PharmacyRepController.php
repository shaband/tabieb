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

    public function __construct(PharmacyRepRepository $repo)
    {
        $this->repo = $repo;

        parent::__construct($repo);

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {

        $pharmacy_reps = $this->repo->all();

        return view($this->viewPath . 'index', compact('pharmacy_reps'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(PharmacyRepository $pharmacyRepo)
    {

        $pharmacies = $pharmacyRepo->all()->pluck('name', 'id');
        return view($this->viewPath . 'create', compact('pharmacies'));
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
    public function edit($id, PharmacyRepository $pharmacyRepo)
    {
        $pharmacies = $pharmacyRepo->all()->pluck('name', 'id');
        $pharmacy_rep = $this->repo->find($id);
        return view($this->viewPath . 'edit', compact('pharmacy_rep'));
    }

    /**
     * @param PharmacyRepRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PharmacyRepRequest $request, $id)
    {
        $pharmacy_rep = $this->repo->UpdatePharmacyRep($request, $id);

        toast(__("Updated successfully"), 'success');

        return redirect()->route($this->routeName . 'index');
    }


}
