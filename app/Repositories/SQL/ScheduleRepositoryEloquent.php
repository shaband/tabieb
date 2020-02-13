<?php

namespace App\Repositories\SQL;

use App\Repositories\SQL\BaseRepository;
use Carbon\CarbonImmutable;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\interfaces\ScheduleRepository;
use App\Models\Schedule;

// use App\Validators\ScheduleValidator;

/**
 * Class ScheduleRepositoryEloquent.
 *
 * @package namespace App\Repositories\SQL;
 */
class ScheduleRepositoryEloquent extends BaseRepository implements ScheduleRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Schedule::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function FindByFromAndToDate(int $doctor_id, string $date, string $from, string $to): ?Schedule
    {

        $day = CarbonImmutable::parse($date)->weekday();

        $schedule = $this->makeModel()
            ->OfDateInPeriod(CarbonImmutable::parse($from))
            ->OfDateInPeriod(CarbonImmutable::parse($to))
            ->where('day', $day + 1)
            ->where('doctor_id', $doctor_id)
            ->first();
        return $schedule;
    }


}
