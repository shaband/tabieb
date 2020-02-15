<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{

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

}
