<?php

namespace App\Models;

use App\Traits\ModelHasLogs;
use Illuminate\Database\Eloquent\Model;

class PatientAnswer extends Model
{
use ModelHasLogs;
    const  STATUS_NO = 0;
    const  STATUS_YES = 1;
    protected $table = 'patient_answers';
    public $timestamps = true;

    protected $fillable = array('patient_id', 'question_id', 'answer', 'status');

    public function question()
    {
        return $this->belongsTo(PatientQuestion::class, 'question_id');
    }

    public function patient()
    {
        return $this->hasOne(Patient::class);
    }

}
