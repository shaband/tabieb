<?php

namespace App\Http\Resources\Chat;

use App\Http\Resources\attachment\AttachmentResource;
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
            'id' => $this->id,
            'chat_id' => $this->chat_id,
            'message' => $this->message,
            'seen_at' => $this->seen_at,
            'sender_type' => $this->sender_type,
            'sender' => $this->when($this->resource->relationLoaded('sender'), function () {
                return [
                    'id' => $this->sender->id,
                    'name' => $this->sender->name,
                    'img' => $this->sender->img,
                ];
            }),
            'chat' => new ChatResource($this->whenLoaded('chat')),
            'attachment_data' => new AttachmentResource($this->whenLoaded('file')),
            'attachment' => $this->attachment
        ];
    }


}
