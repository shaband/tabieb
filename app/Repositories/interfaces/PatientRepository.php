<?php

namespace App\Repositories\interfaces;

use App\Models\Patient;
use App\Repositories\interfaces\BaseInterface;
use Illuminate\Http\Request;

/**
 * Interface PatientRepository.
 *
 * @package namespace App\Repositories\interfaces;
 */
interface PatientRepository extends BaseInterface
{
    /**
     * @param Request $request
     * @return Patient
     */
    public function store(Request $request): Patient;

    /**
     * @param Request $request
     * @return Patient
     */
    public function verify(Request $request): Patient;

    /**
     * @param Request $request
     * @param int $id
     * @return Patient
     */
    public function UpdatePatient(Request $request, int $id): Patient;


    public function AddFCM(Request $request,Patient $patient):void ;

}
