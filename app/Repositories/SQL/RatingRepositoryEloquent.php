<?php

namespace App\Repositories\SQL;

use App\Repositories\SQL\BaseRepository;
use Illuminate\Http\Request;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\interfaces\RatingRepository;
use App\Models\Rating;

// use App\Validators\RatingValidator;

/**
 * Class RatingRepositoryEloquent.
 *
 * @package namespace App\Repositories\SQL;
 */
class RatingRepositoryEloquent extends BaseRepository implements RatingRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Rating::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * @param Request $request
     * @return Rating
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(Request $request): Rating
    {
        $inputs = $request->all();
        $inputs['patient_id'] = auth()->id();
        $rate = $this->create($inputs);

        return $rate;
    }
}
