<?php

namespace App\Repositories\SQL;

use App\Models\Prescription;
use App\Repositories\SQL\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\interfaces\PresciptionRepository;
// use App\Validators\PresciptionValidator;

/**
 * Class PresciptionRepositoryEloquent.
 *
 * @package namespace App\Repositories\SQL;
 */
class PresciptionRepositoryEloquent extends BaseRepository implements PresciptionRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Prescription::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
