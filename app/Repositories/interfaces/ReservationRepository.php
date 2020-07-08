<?php

namespace App\Repositories\interfaces;

use App\Models\Reservation;
use App\Repositories\interfaces\BaseInterface;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
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

    public function startCall(string $reservation_id, ?string $type = "patient", $ring = true);

    public function archiveCall(Request $request);

    /**
     * @param Reservation $reservation
     * @param $opentok
     * @return mixed
     */
    public static function getSessionId(Reservation $reservation, $opentok);

    /**
     * @param string|null $subscriber
     * @param Reservation $reservation
     * @throws ValidationException
     */
    public static function isSubscriberBusy(?string $subscriber, Reservation $reservation): void;

    /**
     * @param string|null $subscriber
     * @param Reservation $reservation
     * @throws ValidationException
     */
    public static function IsSubscriberOffline(?string $subscriber, Reservation $reservation): void;
}
