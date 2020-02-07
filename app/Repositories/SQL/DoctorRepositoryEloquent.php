<?php

namespace App\Repositories\SQL;

use App\Repositories\SQL\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\interfaces\DoctorRepository;
use App\Models\Doctor;
// use App\Validators\DoctorValidator;

/**
 * Class DoctorRepositoryEloquent.
 *
 * @package namespace App\Repositories\SQL;
 */
class DoctorRepositoryEloquent extends BaseRepository implements DoctorRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Doctor::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
