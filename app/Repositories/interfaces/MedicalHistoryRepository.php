<?php

namespace App\Repositories\interfaces;

use App\Repositories\interfaces\BaseInterface;

/**
 * Interface MedicalHistoryRepository.
 *
 * @package namespace App\Repositories\interfaces;
 */
interface MedicalHistoryRepository extends BaseInterface
{
    /**
     * @param int $patient_id
     * @return mixed
     */
    public function getMedicalHistoryForDoctor(int $patient_id);

    /**
     * store medical history with  image if included
     * @param array $attributes
     * @return mixed
     */
    public function store($attributes);
}
