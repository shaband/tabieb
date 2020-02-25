<?php

namespace App\Repositories\interfaces;

use App\Models\Admin;
use App\Models\PharmacyRep;
use App\Repositories\interfaces\BaseInterface;
use Illuminate\Http\Request;

/**
 * Interface PharmacyRepRepository.
 *
 * @package namespace App\Repositories\interfaces;
 */
interface PharmacyRepRepository extends BaseInterface
{
    public function store(Request $request): PharmacyRep;

    public function UpdatePharmacyRep(Request $request, int $id): PharmacyRep;
}
