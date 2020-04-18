<?php

namespace App\Repositories\SQL;

use App\Repositories\SQL\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\interfaces\AuthModelProviderRepository;
use App\Models\AuthModelProvider;
// use App\Validators\AuthModelProviderValidator;

/**
 * Class AuthModelProviderRepositoryEloquent.
 *
 * @package namespace App\Repositories\SQL;
 */
class AuthModelProviderRepositoryEloquent extends BaseRepository implements AuthModelProviderRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return AuthModelProvider::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
