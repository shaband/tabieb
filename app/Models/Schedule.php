<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{

    protected $table = 'schedules';
    public $timestamps = true;
    protected $fillable = array('doctor_id', 'day', 'from_time', 'to_time');

    public function doctor()
    {
        return $this->belongsTo('App\Models\Doctor');
    }

    public function reservations()
    {
        return $this->hasMany('App\Models\Reservation');
    }

}
