<?php

namespace App\Repositories\interfaces;

use App\Models\Schedule;
use App\Repositories\interfaces\BaseInterface;

/**
 * Interface ScheduleRepository.
 *
 * @package namespace App\Repositories\interfaces;
 */
interface ScheduleRepository extends BaseInterface
{
    public function FindByFromAndToDate(int $doctor_id,string $date,string $from,string $to):?Schedule;

}
