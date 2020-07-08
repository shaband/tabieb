<?php

namespace App\Models;

use App\Traits\HasTransaction;
use App\Traits\ModelHasLogs;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Reservation extends Model
{
    use  ModelHasLogs,HasTransaction;

    public const COMMUNICATION_TYPE_AUDIO = 1;
    public const COMMUNICATION_TYPE_VIDEO = 2;
    public const COMMUNICATION_TYPE_BOTH = 3;

    public const STATUS_ACTIVE = 1;
    public const STATUS_ACCEPTED = 2;
    public const STATUS_REFUSED = 3;
    public const STATUS_CANCELED = 4;
    public const STATUS_FINISHED = 5;
    public const STATUS_ON_CALL = 6;

    protected $table = 'reservations';
    public $timestamps = true;
    protected $fillable = array('doctor_id', 'patient_id', 'schedule_id', 'date', 'from_time', 'to_time', 'communication_type', 'status_changed_at', 'status', 'description', 'session_id', 'is_quick');

    protected $casts = [
        'communication_type' => 'integer',
    ];

    public function doctor(): BelongsTo
    {
        return $this->belongsTo('App\Models\Doctor');
    }

    public function patient(): BelongsTo
    {
        return $this->belongsTo('App\Models\Patient');
    }

    public function schedule(): BelongsTo
    {
        return $this->belongsTo('App\Models\Schedule')->withDefault(new Schedule());
    }

    public function prescription(): HasOne
    {
        return $this->hasOne(Prescription::class)->withDefault(new Prescription(['reservation_id' => $this->id, 'doctor_id' => $this->doctor_id, 'patient_id' => $this->patient_id,]));
    }

    public function transaction(): HasOne
    {
        return $this->hasOne(Transaction::class);
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

    public function hasReservation(Carbon $date, Carbon $anchor, Carbon $end)
    {

        $whereDate = Carbon::parse($this->date)->equalTo($date);
        $whereFromDate = Carbon::parse($this->from_time)->lessThanOrEqualTo($anchor);
        $wheretoDate = Carbon::parse($this->to_time)->greaterThanOrEqualTo($end);
        return ($whereDate && $whereFromDate && $wheretoDate);

    }
}
