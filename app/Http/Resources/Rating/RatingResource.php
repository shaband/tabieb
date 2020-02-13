<?php

namespace App\Http\Resources\Rating;

use App\Http\Resources\Doctor\DoctorResource;
use App\Http\Resources\patients\PatientResource;
use App\Models\Reservation;
use Illuminate\Http\Resources\Json\JsonResource;

class RatingResource extends JsonResource
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
            'rate' => $this->rate,
            'description' => $this->description,

            //relashions

            'reservation_id' => new Reservation($this->reservation),
            'doctor_id' => new DoctorResource($this->doctor),
            'patient_id' => new PatientResource($this->patient),
        ];

    }
}
