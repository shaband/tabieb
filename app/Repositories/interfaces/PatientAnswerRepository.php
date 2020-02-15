<?php

namespace App\Repositories\interfaces;

use App\Repositories\interfaces\BaseInterface;

/**
 * Interface PatientAnswerRepository.
 *
 * @package namespace App\Repositories\interfaces;
 */
interface PatientAnswerRepository extends BaseInterface
{
    public function addPatientAnswers(array $answers, array $loads = []): iterable;
}
