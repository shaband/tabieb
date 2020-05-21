<?php

namespace App\Http\Resources\Schedule;

use App\Http\Resources\Doctor\doctorResource;
use App\Http\Resources\Reservation\ReservationResource;
use Carbon\CarbonImmutable;
use Illuminate\Http\Resources\Json\JsonResource;

class ScheduleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {

        $name = days()[$this->day]
            . '-' . CarbonImmutable::parse($this->from_time)->format('h:i A') .
            ':'
            . CarbonImmutable::parse($this->to_time)->format('h:i A');
        return [
            'id' => $this->id,
            'name' => $name,
            'doctor' => new DoctorResource($this->whenLoaded('doctor')),
            'day' => days()[$this->day],
            'from_time' => CarbonImmutable::parse($this->from_time)->format('H:i A'),
            'to_time' => CarbonImmutable::parse($this->to_time)->format('H:i A'),
            'reservations' => ReservationResource::collection($this->whenLoaded('reservations'))
        ];
    }
}
