<?php

namespace App\Http\Resources\Doctor;

use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Schedule\ScheduleResource;
use App\Models\Doctor;
use Illuminate\Http\Resources\Json\JsonResource;

class DoctorResource extends JsonResource
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
            'description' => $this->description,
            'title' => $this->title,
            'email' => $this->email,
            'phone' => $this->phone,
            'price' => $this->price,
            'period' => $this->period,
            'civil_id' => $this->civil_id,
            'gender' => $this->gender == Doctor::GENDER_MALE ? __("Male") : __("Female"),
            'category' => new CategoryResource(/*$this->whenLoaded(*/$this->category/*)*/),
            'sub_categories' => CategoryResource::collection(/*$this->whenLoaded(*/$this->sub_categories/*)*/),
            'email_verified_at' => $this->email_verified_at,
            'phone_verified_at' => $this->phone_verified_at,
            'rating' => $this->ratings->avg('rate') ?? 0,
            'img' => $this->img,
            'schedules' => ScheduleResource::collection($this->whenLoaded('schedules'))

        ];
    }
}
