<?php

namespace App\Repositories\SQL;

use App\Repositories\SQL\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\interfaces\QuestionRepository;
use App\Models\Question;
// use App\Validators\QuestionValidator;

/**
 * Class QuestionRepositoryEloquent.
 *
 * @package namespace App\Repositories\SQL;
 */
class QuestionRepositoryEloquent extends BaseRepository implements QuestionRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Question::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
