<?php

namespace App\Models;

use App\Traits\ColumnTranslation;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    const  PROFILE_PICTURE = 1;
    const  DOCTOR_DOCUMENT = 2;
    protected $table = 'attachments';
    public $timestamps = true;
    protected $fillable = array('file', 'model', 'ext', 'type', 'name');

    public function model()
    {
        return $this->morphTo('model');
    }

}
