<?php

namespace App\Http\Controllers\Website\PharmacyRep;

use App\Repositories\interfaces\PrescriptionRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\MainController as Controller;


class PrescriptionController extends Controller
{
    protected $repo;
    protected $routeName = 'pharmacy.prescriptions.';
    protected $viewPath = 'website.pharmacy_rep.prescriptions.';
    protected $roleName = "";


    public function __construct(PrescriptionRepository $repo)
    {
        $this->repo = $repo;

        parent::__construct($repo, $this->roleName);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function search(Request $request)
    {
        $this->validate($request, [
            'civil_id' => 'required|numeric|exists:patients,civil_id',
            'code' => 'required|numeric|exists:prescriptions,code',
        ]);

        return view('website.pharmacy_rep.prescriptions.search', [
            'prescription' => $this->repo->getOneSearchByCivilAndCode($request->code, $request->civil_id),
        ]);

    }

    public function FinishPrescription($id)
    {
        \Validator::make(['id' => $id], [
            'id' => 'required|integer|exists:prescriptions,id',
        ])->validate();

        $this->repo->finishPrescription($id);

        return redirect()->route('pharmacy.dashboard');
    }
}
