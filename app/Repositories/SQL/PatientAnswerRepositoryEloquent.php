<?php

namespace App\Repositories\SQL;

use App\Repositories\SQL\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\interfaces\PatientAnswerRepository;
use App\Models\PatientAnswer;

// use App\Validators\PatientAnswerValidator;

/**
 * Class PatientAnswerRepositoryEloquent.
 *
 * @package namespace App\Repositories\SQL;
 */
class PatientAnswerRepositoryEloquent extends BaseRepository implements PatientAnswerRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return PatientAnswer::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function addPatientAnswers(array $answers, array $loads = []): iterable
    {
        $ans = [];
        foreach ($answers as $answer) {
            $answer['patient_id'] = auth()->id();

            $ans[] = $this->updateOrCreate(
                [
                    'patient_id' => $answer['patient_id'],
                    'question_id' => $answer['question_id']
                ], $answer)->load($loads);
        }
        return $ans;
    }



}
