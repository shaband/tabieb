<?php

namespace App\Http\Controllers\Website\Doctor;

use App\Http\Controllers\Controller;
use App\Repositories\interfaces\ReservationRepository as ReservationRepositoryAlias;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReservationController extends Controller
{

    /**
     * @var ReservationRepositoryAlias
     */
    private $repo;
    private $path;

    /**
     * ReservationController constructor.
     * @param ReservationRepositoryAlias $repo
     * @param null $path
     */
    public function __construct(ReservationRepositoryAlias $repo, $path = 'website.doctor.profile')
    {
        $this->repo = $repo;
        $this->path = $path ?? 'website.doctor.profile';

        $this->path = $path;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function myRequests()
    {

        $user = auth()->user();

        $reservations = $this->repo->findWhere(
            [
                'doctor_id' => auth()->id(),
                'status' => $this->repo->getConstants()['STATUS_ACTIVE'],
                'date' => [DB::raw('CONCAT(`date`,`from_time`)'), '>=', Carbon::now()]
            ]
        );
        return view($this->path . '.requests', compact('user', 'reservations'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function myAppointment()
    {

        $user = auth()->user();

        $reservations = $this->repo->findWhere(
            [
                'doctor_id' => auth()->id(),
                'status' => $this->repo->getConstants()['STATUS_ACCEPTED'],
                'date' => [DB::raw('CONCAT(`date`,`from_time`)'), '>=', Carbon::now()]
            ]
        );
        return view($this->path . '.appointments', compact('user', 'reservations'));
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function myHistory()
    {

        $user = auth()->user();

        $reservations = $this->repo->findWhere(
            [
                'doctor_id' => auth()->id(),
                //         'status' => $this->repo->getConstants()['STATUS_ACCEPTED'],
                'date' => [DB::raw('CONCAT(`date`,`from_time`)'), '<=', Carbon::now()]
            ]
        );
        return view($this->path . '.histories', compact('user', 'reservations'));
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateStatus($id, Request $request)
    {
        $requests = $request->all();
        $requests['reservation_id'] = $id;
        $this->repo->validate($requests);
        $reservation = $this->repo->updateStatus($request->reservation_id, $request->status);

        toast('Updated Successfully', 'success');
        return back();
    }

}
