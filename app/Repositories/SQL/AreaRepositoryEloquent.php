<?php

namespace App\Repositories\SQL;

use App\Repositories\SQL\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\interfaces\AreaRepository;
use App\Models\Area;
// use App\Validators\AreaValidator;

/**
 * Class AreaRepositoryEloquent.
 *
 * @package namespace App\Repositories\SQL;
 */
class AreaRepositoryEloquent extends BaseRepository implements AreaRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Area::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
