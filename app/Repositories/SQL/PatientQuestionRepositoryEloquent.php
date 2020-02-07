<?php

namespace App\Repositories\SQL;

use App\Repositories\SQL\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\interfaces\PatientQuestionRepository;
use App\Models\PatientQuestion;
// use App\Validators\PatientQuestionValidator;

/**
 * Class PatientQuestionRepositoryEloquent.
 *
 * @package namespace App\Repositories\SQL;
 */
class PatientQuestionRepositoryEloquent extends BaseRepository implements PatientQuestionRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return PatientQuestion::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
