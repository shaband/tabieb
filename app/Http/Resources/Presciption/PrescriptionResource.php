<?php

namespace App\Http\Resources\Presciption;

use App\Http\Resources\Doctor\DoctorResource;
use App\Http\Resources\patients\PatientResource;
use App\Http\Resources\Reservation\ReservationResource;
use App\Models\PrescriptionItem;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class PrescriptionResource extends JsonResource
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
            'reservation' => new ReservationResource($this->whenLoaded('reservation')),
            //'doctor' => new DoctorResource($this->whenLoaded('doctor')),
            'code' => $this->code,
            'date' => $this->created_at->format('Y-m-d'),
            'diagnosis' => $this->diagnosis,
            'description' => $this->description,
            'phramacy_id'=>$this->phramacy_id,
            'taken'=>$this->phramacy_id!=null,
            //'phramacy'=>$this->phramacy,
            'patient' => $this->when($this->resource->relationLoaded('patient'), function () {
                return [
                    'name' => $this->patient->name,
                    'birthdate' => $this->patient->birthdate,
                    'age' => self::getAge($this->patient->birthdate)

                ];
            }),
            'doctor' => $this->when($this->resource->relationLoaded('doctor'), function () {
                return [
                    'name' => $this->doctor->name,
                    'title' => $this->doctor->title,
                    'description' => $this->doctor->description,
                    'logo' => $this->doctor->logo,


                ];
            }),

            // 'phramacy_rep'=>$this->pharmacy_rep,
            // 'phramacy_took_at'=>
            'items' => PrescriptionItemResource::collection($this->whenLoaded('items'))
        ];
    }

    public static function getAge($date = null)
    {


        if ($date == null) {
            return null;
        }

        if ($years = Carbon::now()->diffInYears(Carbon::parse($date))) {
            return $years . __(" Years Old");
        } elseif ($Months = Carbon::now()->diffInMonths(Carbon::parse($date))) {
            return $Months . __(" Months Old");
        } elseif ($days = Carbon::now()->diffInDay(Carbon::parse($date))) {
            return $days . __(" Days Old");
        }

    }
}
