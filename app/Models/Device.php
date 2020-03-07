<?php

namespace App\Models;

use App\Traits\ModelHasLogs;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Device extends Model
{
use ModelHasLogs;
    const DEVICE_TYPE_ANDRIOD = 1;
    const DEVICE_TYPE_IOS = 2;
    const DEVICE_TYPE_BROWSER = 3;

    const TOKEN_TYPE_FCM = 1;

    protected $fillable = ['model_id', 'model_type', 'device_type', 'token', 'token_type'];

    public function model(): MorphTo
    {
        return $this->morphTo('model');
    }
}
