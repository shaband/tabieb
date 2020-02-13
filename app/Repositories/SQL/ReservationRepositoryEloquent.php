<?php

namespace App\Repositories\SQL;

use App\Repositories\interfaces\ScheduleRepository;
use Illuminate\Http\Request;
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
        $schedule = app(ScheduleRepository::class)->FindByFromAndToDate($request->doctor_id, $request->date, $request->from_time, $request->to_time);

        $inputs['schedule_id'] = optional($schedule)->id;
        $inputs['patient_id'] = auth()->user()->id;

        $reservation = $this->create($inputs);
        return $reservation;
    }

    public static function status(): iterable
    {
        $status = self::getConstants('STATUS');

        return $status;
    }
}
