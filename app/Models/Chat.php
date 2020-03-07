<?php

namespace App\Models;

use App\Traits\ModelHasLogs;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
use ModelHasLogs;
    protected $table = 'chats';
    public $timestamps = true;
    protected $fillable = array('doctor_id', 'patient_id', 'reservation_id');

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

}
