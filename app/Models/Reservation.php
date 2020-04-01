<?php

namespace App\Models;

use App\Traits\ModelHasLogs;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use  ModelHasLogs;
    public const COMMUNICATION_TYPE_AUDIO = 1;
    public const COMMUNICATION_TYPE_VIDEO = 2;
    public const COMMUNICATION_TYPE_BOTH = 3;

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
        return $this->belongsTo('App\Models\Schedule')->withDefault(new Schedule());
    }

    public function prescription()
    {
        return $this->hasOne(Prescription::class)->withDefault(new Prescription(['reservation_id' => $this->id, 'doctor_id' => $this->doctor_id, 'patient_id' => $this->patient_id,]));
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

    public function getFromDateAttribute(): CarbonImmutable
    {
        return CarbonImmutable::parse($this->date . ' ' . $this->from_time);
    }

    public function getToDateAttribute(): CarbonImmutable
    {
        return CarbonImmutable::parse($this->date . ' ' . $this->to_time);
    }

    public function getCommunicationTypeStringAttribute(): string
    {
        $string = __("video / voice call");
        if ($this->communication_type == static::COMMUNICATION_TYPE_AUDIO) {
            $string = __("Voice Call");
        } elseif ($this->communication_type == static::COMMUNICATION_TYPE_VIDEO) {
            $string = __("Video Call");
        }
        return $string;
    }

    public function getStatusStrAttribute()
    {

        switch ($this->status) {
            case static::STATUS_ACTIVE:
                $str = __("Active");
                break;
            case static::STATUS_ACCEPTED;
                $str = __("Accepted");
                break;
            case static::STATUS_REFUSED;
                $str = __("Refused");
                break;
            case static::STATUS_CANCELED;
                $str = __("Canceled");
                break;
            case static::STATUS_FINISHED;
                $str = __("Finished");
                break;
            default:
                $str = __("Finished");
        }
        return $str;

    }
}
