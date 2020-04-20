<?php

namespace App\Http\Resources\Doctor;

use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Rating\RatingResource;
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

        if ($this->resource->relationLoaded('schedules')) {
            [
                'available_day' => $available_day,
                'available_from' => $available_from,
                'available_to' => $available_to
            ] = static::formatAvailableTime($this->available_time);
        }
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
            //      'email_verified_at' => $this->email_verified_at,
            'phone_verified_at' => $this->phone_verified_at,
            'img' => $this->img,
            'token' => null,
            'verfication_code' => $this->verification_code,
            'category' => new CategoryResource($this->whenLoaded('category')),
            'sub_categories' => CategoryResource::collection($this->whenLoaded('sub_categories')),
            'schedules' => $this->when($this->resource->relationLoaded('schedules'), $this->weakly_schedules),
            'available_day' => $this->when($this->resource->relationLoaded('schedules'), $available_day ?? null),
            'available_from' => $this->when($this->resource->relationLoaded('schedules'), $available_from ?? null),
            'available_to' => $this->when($this->resource->relationLoaded('schedules'), $available_to ?? null),
            'is_online' => $this->isOnline(),
            'reviews' => RatingResource::collection($this->whenLoaded('ratings')),
            'rating' => round($this->ratings->avg('rate') ?? 0, 0),


        ];
    }

    public static function formatAvailableTime($available_time): array
    {
        return [
            'available_day' => optional($available_time['start'] ?? null)->format('d-M') ?? null,
            'available_from' => optional($available_time['start'] ?? null)->format('h:i A') ?? null,
            'available_to' => optional($available_time['end'] ?? null)->format('h:i A') ?? null,
        ];
    }

}
