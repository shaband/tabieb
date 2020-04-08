<?php

namespace App\Models;

use App\Traits\ModelHasLogs;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Schedule extends Model
{
    use  ModelHasLogs, SoftDeletes;
    const DAY_SAT = 1;
    const DAY_SUN = 2;
    const DAY_MON = 3;
    const DAY_TUE = 4;
    const DAY_WEN = 5;
    const DAY_THR = 6;
    const DAY_FRI = 7;

    const COMMUNICATION_AUDIO = 1;
    const COMMUNICATION_VIDEO = 2;
    const COMMUNICATION_BOTH = 3;

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


    /* attributes */

    public function getReservationTimesAttribute()
    {


        $schedule_day = $this->day;
        $today = CarbonImmutable::now()->dayOfWeek + 1;

        if ($today > $schedule_day) {
            $schedule_day += 6;
        }
        $date =  CarbonImmutable::now()->addDays($schedule_day - $today);
        $period = optional($this->doctor)->period ?? 30;
        $anchor = CarbonImmutable::parse($this->from_time);
        $to = Carbon::parse($this->to_time);
        $times = [];

        while ($anchor->isBefore($to)) {
            $end =   $anchor->addMinutes($period);
            if ($end->isAfter($to)) {
                $end = $to;
            }

            $has_reservation = $this->reservations()->where('status', Reservation::STATUS_ACCEPTED)->whereDate('date', $date)->whereTime('from_time', '<=', $anchor)->whereTime('to_time', '>=', $end)->count();

            $schedule_period = [
                'start' => $anchor,
                'end' => $end,
                'has_reservation' => $has_reservation
            ];
            $times[] = $schedule_period;
            $anchor = $end;
        }

        return $times;
    }
    public function setFromTimeAttribute($value): void
    {
        $value = str_replace(" : ", ":", $value);
        $this->attributes['from_time'] = Carbon::parse($value);
    }

    public function setToTimeAttribute($value): void
    {
        $value = str_replace(" : ", ":", $value);

        $this->attributes['to_time'] = Carbon::parse($value);
    }

    public function scopeOfDateInPeriod(Builder $builder, $value): void
    {
        $builder->whereTime('from_time', '<=', $value);
        $builder->whereTime('to_time', '>=', $value);
    }
}
