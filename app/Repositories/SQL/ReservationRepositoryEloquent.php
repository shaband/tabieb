<?php

namespace App\Repositories\SQL;

use App\Repositories\interfaces\ScheduleRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
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
        $this->pushCriteria(app(RequestCriteria::class));
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


    public function getDoctorReservationByStatus($doctor_id, $status, $date = null)
    {


        return $this->query()->with(['patient' => function ($patient) {
            $patient->with('image:file');
        }])->where('doctor_id', $doctor_id)
            ->when($date != null,
                function ($q) use ($date) {
                    $q->whereDate('date', '>=', $date);
                })
            ->where('status', $status)->orderBy(DB::raw('date'), 'asc')->get();

    }

}
