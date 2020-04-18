<?php

namespace App\Repositories\SQL;

use App\Models\PatientAnswer;
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

    public function WithAnswersOfPatient(int $patient_id)
    {

        $questions = $this->query()->all();

        $answers = auth()->user()->patient_answers;

        $questions = $questions->map(function ($question) use ($answers) {
            $patient_answer_on_this_question = optional($answers->where('question_id', $question->id)->first());

            $question->status = $patient_answer_on_this_question->status;
            $question->answer = $patient_answer_on_this_question->answer;

            return $question;
        });
        return $questions;
    }
}
