<?php

namespace App\Repositories\SQL;

use App\Repositories\SQL\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\interfaces\FavouriteRepository;
use App\Models\Favourite;
// use App\Validators\FavouriteValidator;

/**
 * Class FavouriteRepositoryEloquent.
 *
 * @package namespace App\Repositories\SQL;
 */
class FavouriteRepositoryEloquent extends BaseRepository implements FavouriteRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Favourite::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
