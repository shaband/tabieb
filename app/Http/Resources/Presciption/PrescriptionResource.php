<?php

namespace App\Http\Resources\Presciption;

use App\Http\Resources\Doctor\DoctorResource;
use App\Http\Resources\Reservation\ReservationResource;
use App\Models\PrescriptionItem;
use Illuminate\Http\Resources\Json\JsonResource;

class PrescriptionResource extends JsonResource
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
            'code' => $this->code,
            'diagnosis' => $this->diagnosis,
            'description' => $this->description,
            //'phramacy'=>$this->phramacy,
            'patient' => new ReservationResource($this->whenLoaded('reservation')),
            // 'phramacy_rep'=>$this->pharmacy_rep,
            // 'phramacy_took_at'=>
            'items'=>PrescriptionItemResource::collection($this->whenLoaded('items'))
        ];
    }
}
