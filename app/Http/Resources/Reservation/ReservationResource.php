<?php

namespace App\Http\Resources\Reservation;

use App\Http\Resources\Doctor\DoctorResource;
use App\Http\Resources\patients\PatientResource;
use App\Http\Resources\Schedule\ScheduleResource;
use App\Models\Reservation;
use App\Repositories\interfaces\ReservationRepository;
use Carbon\CarbonImmutable;
use Illuminate\Http\Resources\Json\JsonResource;

class ReservationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'date' => CarbonImmutable::parse($this->date)->toDateString(),
            'date_string' => CarbonImmutable::parse($this->date)->diffForHumans(),
            'from_time' => CarbonImmutable::parse($this->from_time)->toTimeString(),
            'to_time' => CarbonImmutable::parse($this->to_time)->toTimeString(),
            'communication_type' => self::getCommunicationType($this->communication_type),
            'status_changed_at' => $this->status_changed_at ? CarbonImmutable::parse($this->status_changed_at) : null,
            'status' => self::getStatus($this->status),
            'description' => $this->description,


            //relations


            'doctor' => new DoctorResource($this->whenLoaded('doctor')),
            'schedule' => new DoctorResource($this->whenLoaded('schedule')),
            'patient' => /*new PatientResource(*/ $this->whenLoaded('patient', function () {

                return [
                    'name' => $this->patient->name,
                    'id' => $this->patient_id,
                    'img' => $this->patient->img
                ];
            })/*)*/,
        ];
    }

    public static function getCommunicationType($type)
    {
        $status = app(ReservationRepository::class)->getConstantsFlipped('COMMUNICATION_TYPE')[$type];
        return __($status);
    }

    public static function getStatus($status)
    {
        $status = app(ReservationRepository::class)->getConstantsFlipped('STATUS')[$status];
        return __($status);
    }
}
