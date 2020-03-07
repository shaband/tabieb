<?php

namespace App\Models;

use App\Traits\ColumnTranslation;
use App\Traits\ModelHasLogs;
use Illuminate\Database\Eloquent\Model;

class PatientQuestion extends Model
{
    use ColumnTranslation,ModelHasLogs;
    protected $table = 'patient_questions';
    public $timestamps = true;
    protected $fillable = array('name_ar', 'name_en');

    public function patient_answers()
    {
        return $this->hasMany('Models\PatientAnswer');
    }

}
