<?php

namespace App\Repositories\interfaces;

use App\Models\Doctor;
use App\Repositories\interfaces\BaseInterface;
use Illuminate\Http\Request;

/**
 * Interface DoctorRepository.
 *
 * @package namespace App\Repositories\interfaces;
 */
interface DoctorRepository extends BaseInterface
{
    public function store(Request $request): Doctor;

    public function UpdateDoctor(Request $request, int $id): Doctor;

}
