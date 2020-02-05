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
        return $this->belongsTo('App\Models\Doctor');
    }

    public function patient()
    {
        return $this->belongsTo('App\Models\Patient');
    }

    public function reservation()
    {
        return $this->belongsTo('App\Models\Reservation');
    }

}
