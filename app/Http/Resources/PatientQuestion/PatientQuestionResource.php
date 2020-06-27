<?php

namespace App\Http\Resources\PatientQuestion;

use Illuminate\Http\Resources\Json\JsonResource;

class PatientQuestionResource extends JsonResource
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
            'answer' => [
                'status' => $this->status,
                'answer' => $this->answer,
            ]
        ];
    }
}
