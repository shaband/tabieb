<?php

namespace App\Http\Resources\PatientAnswer;

use Illuminate\Http\Resources\Json\JsonResource;

class PatientAnswerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
