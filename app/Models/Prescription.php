<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{

    protected $table = 'prescriptions';
    public $timestamps = true;
    protected $fillable = array('reservation_id', 'code', 'diagnosis', 'description', 'phramacy_id', 'patient_id', 'phramacy_rep_id', 'phramacy_took_at');

    public function reservation()
    {
        return $this->belongsTo('App\Models\Reservation');
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

}
