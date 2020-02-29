<?php

namespace App\Http\Resources\attachment;

use App\Http\Resources\Doctor\DoctorResource;
use App\Http\Resources\patients\PatientResource;
use Illuminate\Http\Resources\Json\JsonResource;

class AttachmentResource extends JsonResource
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
            'name' => $this->name,
            'file' => $this->file,
            //  'model' => $this->model_type == 'doctors' ? new DoctorResource($this->whenLoaded($this->model)) : new PatientResource($this->whenLoaded($this->model))
        ];
    }
}
