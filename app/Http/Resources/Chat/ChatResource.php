<?php

namespace App\Http\Resources\Chat;

use App\Http\Resources\Doctor\DoctorResource;
use App\Http\Resources\patients\PatientResource;
use App\Http\Resources\Reservation\ReservationResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ChatResource extends JsonResource
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
            'messages' => MessageResource::collection($this->whenLoaded('messages')),
            'last_message' => optional($this->messages()->orderBy('id', 'desc')->first())->message,
            'unseen_messages' => $this->messages()->where('sender_type', 'doctors')->where('seen_at', '!=', null)->count(),
            'doctor' => new DoctorResource($this->whenLoaded('doctor')),
            'patient' => new PatientResource($this->whenLoaded('patient')),
            'reservation' => new ReservationResource($this->whenLoaded('reservation')),
            'id' => $this->id,
        ];
    }
}
