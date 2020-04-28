<?php

namespace App\Http\Resources\patients;

use App\Http\Resources\area\AreaResource;
use App\Http\Resources\block\BlockResource;
use App\Http\Resources\district\DistrictResource;
use App\Http\Resources\SocialSecurity\SocialSecurityResource;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class PatientResource extends JsonResource
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
            'username' => $this->username,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'civil_id' => $this->civil_id,
            'social_security_id' => $this->social_security_id,
            'blocked_at' => $this->blocked_at,
            'blocked_reason' => $this->blocked_reason,
            'birthdate' => $this->birthdate,
            'img' => fileUrl($this->img),

            'age' => $this->birthdate ? Carbon::now()->diffInYears($this->birthdate) : null,
            //   'district_id' => $this->district_id,
            //   'area_id' => $this->area_id,
            //   'block_id' => $this->block_id,
            'gender' => $this->gender,
            'verification_code' => $this->verification_code,
            'phone_verified_at' => $this->phone_verified_at,
            'email_verified_at' => $this->email_verified_at,
            'token' => null,
            //relationship
            'social_security' => new SocialSecurityResource($this->whenLoaded('social_security')),
        ];
    }
}
