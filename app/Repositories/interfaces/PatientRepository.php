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
    public function store(Request $request): Patient;

    public function verify(Request $request): Patient;


}
