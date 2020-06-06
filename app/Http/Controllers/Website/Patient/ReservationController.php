<?php

namespace App\Http\Controllers\Website\Patient;

use App\Http\Controllers\Website\ReservationController as Controller;
use App\Http\Requests\Website\RatingRequest;
use App\Models\Chat;
use App\Repositories\interfaces\DoctorRepository;
use App\Repositories\interfaces\ReservationRepository;
use App\Repositories\interfaces\ScheduleRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReservationController extends Controller
{
    /**
     * @var ScheduleRepository
     */
    protected $scheduleRepo;
    /**
     * @var ReservationRepository
     */
    protected $reservationRepo;
    /**
     * @var DoctorRepository
     */
    protected $doctorRepo;

    /**
     * ReservationController constructor.
     * @param ScheduleRepository $scheduleRepo
     * @param ReservationRepository $reservationRepo
     * @param DoctorRepository $doctorRepo
     */
    public function __construct(ScheduleRepository $scheduleRepo, ReservationRepository $reservationRepo, DoctorRepository $doctorRepo)
    {
        parent::__construct($scheduleRepo, $reservationRepo, $doctorRepo);
        $this->scheduleRepo = $scheduleRepo;
        $this->reservationRepo = $reservationRepo;
        $this->doctorRepo = $doctorRepo;
    }

    public function rate(RatingRequest $request, $reservation_id)
    {

        $reservation = $this->reservationRepo->find($reservation_id);

        $attributes =
            [
                'patient_id' => $reservation->patient_id,
                'doctor_id' => $reservation->dotor_id,
                'reservation_id' => $reservation_id
            ];

        $rate = $reservation->rating()->updateOrCreate($attributes, $request->all());

        toast(__('Saved Successfully'), 'success');

        return redirect()->route('home');

    }


    public function BeginCall(Request $request, $reservation_id)
    {
        [
            'sessionId' => $sessionId,
            'token' => $token,
            'reservation' => $reservation,
        ] =
            $this->reservationRepo->startCall($reservation_id, 'doctor', $ring = true);

        return view('call', [
                'token' => $token,
                'sessionId' => $sessionId,
                'type' => 'patient',
                'reservation' => $reservation,
                'status' => $this->reservationRepo::getConstants()['STATUS_ACTIVE'],
                'chat' => new Chat()
            ]
        );
    }
}
