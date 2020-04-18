<?php

namespace App\Http\Resources\Rating;

use App\Http\Resources\Doctor\DoctorResource;
use App\Http\Resources\patients\PatientResource;
use App\Http\Resources\Reservation\ReservationResource;
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
            'reservation' => new ReservationResource($this->whenLoaded('reservation')),
            'doctor' => new DoctorResource($this->whenLoaded('doctor')),

            //   'patient' => new PatientResource($this->whenLoaded('patient')),
            'id' => $this->id,
            'rate' => $this->rate,
            'description' => $this->description,
            'patient_name' => optional($this->patient)->name ?? "",
            'patient_img' => optional($this->patient)->img ?? "",

            //relashions

        ];

    }
}
