<?php

namespace App\Repositories\interfaces;

use App\Models\Reservation;
use App\Repositories\interfaces\BaseInterface;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Integer;

/**
 * Interface ReservationRepository.
 *
 * @package namespace App\Repositories\interfaces;
 */
interface ReservationRepository extends BaseInterface
{
    public function store(Request $request): Reservation;

    public static function status(): iterable;

    public static function updateStatus(int $reservation_id, int $status): Reservation;

    public function validate(array $request): void;

    public function getDoctorReservationByStatus($doctor_id, $status, $data = null);


    public function storeQuickCall(array $data): Reservation;

    public function makeQuickCall(Request $request): array;

    public function startCall(string $reservation_id);

    public function archiveCall(Request $request);

}
