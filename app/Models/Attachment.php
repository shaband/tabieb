<?php

namespace App\Models;

use App\Traits\ColumnTranslation;
use App\Traits\ModelHasLogs;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    use ModelHasLogs;
    const  PROFILE_PICTURE = 1;
    const  DOCTOR_DOCUMENT = 2;
    const  DOCTOR_Logo = 3;
    protected $table = 'attachments';
    public $timestamps = true;
    protected $fillable = array('file', 'model_id','model_type', 'ext', 'type', 'name');

    public function model()
    {
        return $this->morphTo('model');
    }

}
