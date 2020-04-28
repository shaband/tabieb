<?php

namespace App\Repositories\interfaces;

use App\Repositories\interfaces\BaseInterface;

/**
 * Interface PrescriptionRepository.
 *
 * @package namespace App\Repositories\interfaces;
 */
interface PrescriptionRepository extends BaseInterface
{
    /**
     * search for  prescription  and get first result for pharmacy
     * @param integer $code
     * @param integer $civil_id
     * @return mixed
     */
    public function getOneSearchByCivilAndCode($code, $civil_id);
    public function finishPrescription($id);
}
