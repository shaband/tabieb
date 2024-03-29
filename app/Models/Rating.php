<?php

namespace App\Models;

use App\Traits\ModelHasLogs;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use  ModelHasLogs;

    protected $table = 'ratings';
    public $timestamps = true;
    protected $fillable = array('rate', 'reservation_id', 'doctor_id', 'patient_id', 'description');

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }


    public static function rules()
    {

        return [
            'reservation_id' => 'required|integer|exists:reservations,id,patient_id,' . auth()->user()->id,
            'description' => 'nullable|string',
            'rate' => 'required|integer|min:0|max:5'
        ];
    }
}
