<?php

namespace App\Repositories\SQL;

use App\Repositories\SQL\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\interfaces\PermissionRepository;
use App\Models\Permission;
// use App\Validators\PermissionValidator;

/**
 * Class PermissionRepositoryEloquent.
 *
 * @package namespace App\Repositories\SQL;
 */
class PermissionRepositoryEloquent extends BaseRepository implements PermissionRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Permission::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
