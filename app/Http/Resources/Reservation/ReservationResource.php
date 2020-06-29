<?php

namespace App\Http\Resources\Reservation;

use App\Http\Resources\Doctor\DoctorResource;

use App\Http\Resources\Transaction\TransactionResource;
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
            'status_label' => self::getStatus($this->status),
            'status' => $this->status,
            'description' => $this->description,
            'session_id' => $this->session_id,
            'is_quick' => $this->is_quick,

            //relations


            'doctor' => /*new DoctorResource(*/ $this->whenLoaded('doctor', function () {

                return [
                    'name' => $this->doctor->name,
                    'id' => $this->doctor_id,
                    'img' => fileUrl($this->doctor->img)
                ];
            }, null)/*)*/,
            'schedule' => new DoctorResource($this->whenLoaded('schedule')),
            'patient' => /*new PatientResource(*/ $this->whenLoaded('patient', function () {

                return [
                    'name' => $this->patient->name,
                    'id' => $this->patient_id,
                    'img' => fileUrl($this->patient->img)
                ];
            }),
         'transaction'=>$this->whenLoaded('transaction',new TransactionResource($this->transaction))
        ];
    }

    public static function getCommunicationType($type)
    {
        $status = app(ReservationRepository::class)->getConstantsFlipped('COMMUNICATION_TYPE')[$type] ?? $type;
        return __($status);
    }

    public static function getStatus($status)
    {
        $status = app(ReservationRepository::class)->getConstantsFlipped('STATUS')[$status]??$status;
        return __($status);
    }
}
