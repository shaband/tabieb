<?php

namespace App\Http\Resources\PatientAnswer;

use App\Http\Resources\PatientQuestion\PatientQuestionResource;
use Illuminate\Http\Resources\Json\JsonResource;

class PatientAnswerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return
            [
                'id' => $this->id,
                'status' => $this->status,
                'answer' => $this->answer,
                'question' => new PatientQuestionResource($this->whenLoaded('question'))
            ];
    }
}
