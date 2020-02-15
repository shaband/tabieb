<?php

namespace App\Http\Resources\Chat;

use App\Http\Resources\Doctor\DoctorResource;
use App\Http\Resources\patients\PatientResource;
use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
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
            'chat' => new ChatResource($this->whenLoaded('chat')),
            'message' => $this->message,
            'sender_type' => $this->sender_type,
            'sender' => $this->sender_type == 'patient' ? new PatientResource($this->sender) : new DoctorResource($this->sender),
            'seen_at' => $this->seen_at,

        ];
    }
}
