<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    const  PROFILE_PICTURE = 1;
    protected $table = 'attachments';
    public $timestamps = true;
    protected $fillable = array('file', 'model', 'ext', 'type');

    public function model()
    {
        return $this->morphTo('model');
    }

}
