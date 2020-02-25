<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{

    protected $table = 'contacts';
    public $timestamps = true;
    protected $fillable = ['name', 'email', 'model_id', 'model_type', 'subject', 'message', 'seen_at', 'seen_by', 'reply'];

    public function model()
    {
        return $this->morphTo('model');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'seen_by');
    }

}
