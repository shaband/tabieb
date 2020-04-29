<?php

namespace App\Models;

use App\Traits\ModelHasLogs;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use ModelHasLogs;

    protected $table = 'prescriptions';
    public $timestamps = true;
    protected $fillable = array('reservation_id', 'doctor_id', 'code', 'diagnosis', 'description', 'phramacy_id', 'patient_id', 'phramacy_rep_id', 'phramacy_took_at');

    public function reservation()
    {
        return $this->belongsTo('App\Models\Reservation');
    }

    public function doctor()
    {
        return $this->belongsTo('App\Models\Doctor');
    }

    public function pharamacy()
    {
        return $this->belongsTo('App\Models\Pharmacy');
    }

    public function patient()
    {
        return $this->belongsTo('App\Models\Patient');
    }

    public function pharamacy_rep()
    {
        return $this->belongsTo('App\Models\PharmacyRep');
    }

    public function items()
    {

        return $this->hasMany(PrescriptionItem::class, 'prescription_id');
    }

    //scopes

    public function scopeOfCivilId(Builder $builder, $value): void
    {

        $builder->whereHas('patient', function (Builder $patient) use ($value) {
            $patient->where('civil_id', $value);
        });
    }

    public function scopeAvailable(Builder $builder): void
    {
        $builder->whereNull('phramacy_took_at')
            ->whereNull('phramacy_rep_id')
            ->whereNull('phramacy_id');
    }


    //attributes()
    public function getIsAvailableAttribute()
    {
        return ($this->phramacy_took_at == null && $this->phramacy_rep_id == null && $this->phramacy_id == null);

    }
}
