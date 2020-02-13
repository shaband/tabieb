<?php

namespace App\Repositories\interfaces;

use App\Models\Reservation;
use App\Repositories\interfaces\BaseInterface;
use Illuminate\Http\Request;

/**
 * Interface ReservationRepository.
 *
 * @package namespace App\Repositories\interfaces;
 */
interface ReservationRepository extends BaseInterface
{
    public function store(Request $request):Reservation;
    public static function status():iterable;
}
