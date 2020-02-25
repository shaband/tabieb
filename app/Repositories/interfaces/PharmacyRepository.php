<?php

namespace App\Repositories\interfaces;

use App\Models\Pharmacy;
use App\Repositories\interfaces\BaseInterface;
use Illuminate\Http\Request;

/**
 * Interface PharmacyRepository.
 *
 * @package namespace App\Repositories\interfaces;
 */
interface PharmacyRepository extends BaseInterface
{
    /**
     * @param Request $request
     * @return Pharmacy
     */
    public function store(Request $request): Pharmacy;

    /**
     * @param Request $request
     * @return Pharmacy
     */
    public function verify(Request $request): Pharmacy;

    /**
     * @param Request $request
     * @param int $id
     * @return Pharmacy
     */
    public function UpdatePharmacy(Request $request, int $id): Pharmacy;

}
