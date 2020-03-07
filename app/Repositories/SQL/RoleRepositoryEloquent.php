<?php

namespace App\Repositories\SQL;

use App\Repositories\SQL\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\interfaces\RoleRepository;
use App\Models\Role;
// use App\Validators\RoleValidator;

/**
 * Class RoleRepositoryEloquent.
 *
 * @package namespace App\Repositories\SQL;
 */
class RoleRepositoryEloquent extends BaseRepository implements RoleRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Role::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
