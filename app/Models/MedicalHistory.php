<?php

namespace App\Models;

use App\Traits\ModelHasLogs;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class MedicalHistory extends Model
{
    use ModelHasLogs;

    protected $fillable = [
        'patient_id',
        'creator_type',
        'creator_id',
        'reservation_id',
        'category_id',
        'title',
        'date',
        'description',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function creator()
    {
        return $this->morphTo('creator');
    }

    public function image()
    {
        return $this->morphOne(Attachment::class, 'model')
            ->where('type', Attachment::MEDICAL_HISTORY)
            ->latest();
    }

    public function setDateAttribute($value)
    {

        $this->attributes['date'] = Carbon::parse($value);
    }
}
