<?php

namespace App\Repositories\SQL;

use App\Repositories\SQL\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\interfaces\SocialSecurityRepository;
use App\Models\SocialSecurity;
// use App\Validators\SocialSecurityValidator;

/**
 * Class SocialSecurityRepositoryEloquent.
 *
 * @package namespace App\Repositories\SQL;
 */
class SocialSecurityRepositoryEloquent extends BaseRepository implements SocialSecurityRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return SocialSecurity::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
