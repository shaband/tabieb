<?php

namespace App\Repositories\SQL;

use App\Criteria\OrderReservationByDateCriteria;
use App\Events\CallStarted;
use App\Models\Chat;
use App\Repositories\interfaces\ScheduleRepository;
use App\Services\Contracts\TokBoxContract;
use App\Services\Drivers\TokBoxDriver;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use OpenTok\OutputMode;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\interfaces\ReservationRepository;
use App\Models\Reservation;

// use App\Validators\ReservationValidator;

/**
 * Class ReservationRepositoryEloquent.
 *
 * @package namespace App\Repositories\SQL;
 */
class ReservationRepositoryEloquent extends BaseRepository implements ReservationRepository

{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Reservation::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        Parent::boot();
        $this->pushCriteria(app(OrderReservationByDateCriteria::class));

    }

    public function store(Request $request): Reservation
    {
        $inputs = $request->all();
        if ($request->schedule_id == null) {
            $schedule = app(ScheduleRepository::class)->FindByFromAndToDate($request->doctor_id, $request->date, $request->from_time, $request->to_time);
            //check for admin and api (api get from auth & admin from request)
            $inputs['schedule_id'] = optional($schedule)->id;
            //check for admin and api (api get from auth & admin from request)
        }
        if ($request->patient_id == null) {
            $inputs['patient_id'] = auth()->user()->id;
        }
        $reservation = $this->create($inputs);
        return $reservation;
    }

    public static function status(): iterable
    {
        $status = self::getConstants('STATUS');

        return $status;
    }


    public static function updateStatus(int $reservation_id, int $status): Reservation
    {

        $attributes = [
            'status' => $status,
            'status_changed_at' => Carbon::now(),
        ];
        $reservation = app(ReservationRepository::class)->update($attributes, $reservation_id);

        return $reservation;
    }

    /**
     * @param Request $request
     * @throws ValidationException
     */
    public function validate(array $request = []): void
    {
        $validator = Validator::make($request, [
            'reservation_id' => 'required|integer|exists:reservations,id,doctor_id,' . auth()->user()->id,
            'status' => ['required', 'integer',
                Rule::in(
                    [
                        Reservation::STATUS_ACCEPTED,
                        Reservation::STATUS_REFUSED,
                        Reservation::STATUS_CANCELED
                    ])],
        ]);
        if ($validator->fails()) {
            throw new  ValidationException($validator);
        }

    }

    public function storeQuickCall(array $data): Reservation
    {
        return $this->firstOrcreate(['id' => \request()->reservation_id], $data + [
                'is_quick' => true,
                'date' => Carbon::now(),
            ]);

    }


    public function makeQuickCall(Request $request): array
    {
        $reservation = $this->storeQuickCall($request->only('patient_id', 'doctor_id', 'communication_type'));

        $subscriber= auth()->guard('doctor')->check() ? null : 'doctor';
        return $this->startCall($reservation->id,$subscriber,($subscriber != null || \request()->reservation_id == null));
    }

    public function getDoctorReservationByStatus($doctor_id, $status, $date = null)
    {
        return $this->with(['patient' => function ($patient) {
            $patient->with('image:file');
        }])->where('doctor_id', $doctor_id)
            ->when($date != null,
                function ($q) use ($date) {
                    $q->whereDate('date', '>=', $date);
                })
            ->where('status', $status)->orderBy(DB::raw('date'), 'asc')->get();

    }


    public function startCall(string $reservation_id, ?string $subscriber = 'patient',$ring=true)
    {
        $opentok = app(TokBoxContract::class);

        $reservation = $this->find($reservation_id);
        if ($reservation->session_id == null) {

            $sessionId = $opentok->defaultSession()->getSessionId();
            $reservation->fill(['session_id' => $sessionId])->save();

        } else {
            $sessionId = $reservation->session_id;
        }

        $token = $opentok->generateToken($sessionId);
        if ($ring) {
            event(new CallStarted($reservation, $subscriber));
        }
        return ['sessionId' => $sessionId, 'token' => $token, 'reservation' => $reservation];

    }

    public function archiveCall(Request $request)
    {
        // Create a simple archive of a session
        $opentok = app(TokBoxContract::class);

        $archive = $opentok->startArchive($request->sessionId);


        // Create an archive using custom options
        $archiveOptions = array(
            'name' => 'call',     // default: null
            'hasAudio' => true,                     // default: true
            'hasVideo' => true,                     // default: true
            'outputMode' => OutputMode::COMPOSED,   // default: OutputMode::COMPOSED
            'resolution' => '1280x720'              // default: '640x480'
        );
        $archive = $opentok->startArchive($request->sessionId, $archiveOptions);

        // Store this archiveId in the database for later use
        $archiveId = $archive->id;
        return $archiveId;
    }


}
