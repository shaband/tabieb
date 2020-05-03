<?php

namespace App\Http\Resources\MedicalHistory;

use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\patients\PatientResource;
use Illuminate\Http\Resources\Json\JsonResource;

class MedicalHistoryResource extends JsonResource
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
            'title' => $this->title,
            'date' => $this->date,
            'description' => $this->description,
            'creator_type' => $this->creator_type,
            'image' => fileUrl($this->img ?? $this->image),

            'patient' => new PatientResource($this->whenLoaded('patient')),
            'category' => new CategoryResource($this->whenLoaded('category')),
            'creator' => $this->when($this->resource->relationLoaded('creator'), function () {
                return [
                    'id' => $this->creator->id,
                    'name' => $this->creator->name,
                ];

            }),

        ];
    }
}
