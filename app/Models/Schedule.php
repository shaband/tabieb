<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{

    const DAY_SAT = 1;
    const DAY_SUN = 2;
    const DAY_MON = 3;
    const DAY_TUE = 4;
    const DAY_WEN = 5;
    const DAY_THR = 6;
    const DAY_FRI = 7;

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

    public function setFromTimeAttribute($value): void
    {
        $this->attributes['from_time'] = Carbon::parse($value);
    }

    public function setToTimeAttribute($value): void
    {
        $this->attributes['to_time'] = Carbon::parse($value);
    }

}
