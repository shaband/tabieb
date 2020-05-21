<?php

namespace App\Http\Resources\Doctor;

use App\Http\Resources\attachment\AttachmentResource;
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
            "first_name_ar" => $this->first_name_ar,
            "last_name_ar" => $this->last_name_ar,
            "first_name_en" => $this->first_name_en,
            "last_name_en" => $this->last_name_en,

            "description_ar" => $this->description_ar,
            "description_en" => $this->description_en,
            "title_ar" => $this->title_ar,
            "title_en" => $this->title_en,
            'description' => $this->description,
            'title' => $this->title,
            'email' => $this->email,
            'phone' => $this->phone,
            'price' => $this->price,
            'period' => $this->period,
            'civil_id' => $this->civil_id,
            'license_number' => $this->license_number,
            'gender' => $this->gender == Doctor::GENDER_MALE ? __("Male") : __("Female"),
            'phone_verified_at' => $this->phone_verified_at,
            'img' => fileUrl($this->img),
            'logo' => fileUrl($this->logo),
            'token' => null,
            'verfication_code' => $this->verification_code,

            //relashions
            'category' => new CategoryResource($this->whenLoaded('category')),
            'sub_categories' => CategoryResource::collection($this->whenLoaded('sub_categories')),
            'schedules' => $this->when($this->resource->relationLoaded('schedules'), $this->weakly_schedules),
            'available_day' => $this->when($this->resource->relationLoaded('schedules'), $available_day ?? null),
            'available_from' => $this->when($this->resource->relationLoaded('schedules'), $available_from ?? null),
            'available_to' => $this->when($this->resource->relationLoaded('schedules'), $available_to ?? null),
            'is_online' => $this->isOnline(),
            'reviews' => RatingResource::collection($this->whenLoaded('ratings')),
            'rating' => round($this->ratings->avg('rate') ?? 0, 0),
            'papers' => AttachmentResource::collection($this->whenLoaded('papers')),


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
