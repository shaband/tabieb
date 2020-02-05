<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{

    protected $table = 'reservations';
    public $timestamps = true;
    protected $fillable = array('doctor_id', 'patient_id', 'schedule_id', 'from_time', 'to_time', 'comunication_type', 'canceled_at', 'status', 'description');

    public function doctor()
    {
        return $this->belongsTo('App\Models\Doctor');
    }

    public function patient()
    {
        return $this->belongsTo('App\Models\Patient');
    }

    public function schedule()
    {
        return $this->belongsTo('App\Models\Schedule');
    }

    public function prescription()
    {
        return $this->hasOne('App\Models\Prescription');
    }

    public function invoices()
    {
        return $this->hasMany('App\Models\Invoice');
    }

    public function rating()
    {
        return $this->hasOne('App\Models\Rating');
    }

    public function chat()
    {
        return $this->hasOne('App\Models\Chat');
    }

}
