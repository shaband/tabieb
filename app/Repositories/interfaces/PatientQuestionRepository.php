<?php

namespace App\Repositories\interfaces;

use App\Repositories\interfaces\BaseInterface;
use Illuminate\Database\Eloquent\Collection;

/**
 * Interface PatientQuestionRepository.
 *
 * @package namespace App\Repositories\interfaces;
 */
interface PatientQuestionRepository extends BaseInterface
{
    public function WithAnswersOfPatient(int $patient_id);

}
