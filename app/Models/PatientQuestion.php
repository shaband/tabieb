<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PatientQuestion extends Model
{

    protected $table = 'patient_questions';
    public $timestamps = true;
    protected $fillable = array('name_ar', 'name_en');

    public function patient_answers()
    {
        return $this->hasMany('Models\PatientAnswer');
    }

}
