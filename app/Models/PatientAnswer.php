<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PatientAnswer extends Model
{

    protected $table = 'patient_answers';
    public $timestamps = true;
    protected $fillable = array('patient_id', 'question_id', 'answer');

    public function question()
    {
        return $this->belongsTo('App\Models\PatientQuestion', 'question_id');
    }

    public function patient_id()
    {
        return $this->hasOne('App\Models\Patient');
    }

}
