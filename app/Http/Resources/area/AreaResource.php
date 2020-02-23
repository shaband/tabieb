<?php

namespace App\Http\Resources\area;

use Illuminate\Http\Resources\Json\JsonResource;

class AreaResource extends JsonResource
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
            'id'=>$this->id,
            'name_ar' => $this->name_ar,
            'name_en' => $this->name_en,
            'name' => $this->name,
            ];
    }
}
