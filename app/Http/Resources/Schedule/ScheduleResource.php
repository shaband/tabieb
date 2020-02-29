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
        return [
            'id' => $this->id,
            'doctor' => new DoctorResource($this->whenLoaded('doctor')),
            'day' => days()[$this->day],
            'from_time' => CarbonImmutable::parse($this->from_time)->toTimeString(),
            'to_time' => CarbonImmutable::parse($this->to_time)->toTimeString(),
            'reservation' => ReservationResource::collection(/*$this->whenLoaded(*/ $this->reservations)/*)*/
        ];
    }
}
