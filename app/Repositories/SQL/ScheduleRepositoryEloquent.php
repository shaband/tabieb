<?php

namespace App\Repositories\SQL;

use App\Repositories\SQL\BaseRepository;
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

}
