<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{

    public const AUDIO_TYPE_COMMUNICATION = 1;
    public const VIDEO_TYPE_COMMUNICATION = 1;

    public const STATUS_ACTIVE = 1;
    public const STATUS_ACCEPTED = 2;
    public const STATUS_REFUSED = 3;
    public const STATUS_CANCELED = 4;
    public const STATUS_FINISHED = 5;

    protected $table = 'reservations';
    public $timestamps = true;
    protected $fillable = array('doctor_id', 'patient_id', 'schedule_id', 'date', 'from_time', 'to_time', 'communication_type', 'status_changed_at', 'status', 'description');

    protected $casts = [
        'communication_type' => 'integer',
    ];

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

    public function setFromTimeAttribute($value): void
    {
        $this->attributes['from_time'] = Carbon::parse($value);
    }

    public function setToTimeAttribute($value): void
    {
        $this->attributes['to_time'] = Carbon::parse($value);
    }

}
