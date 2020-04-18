<?php

namespace App\Models;

use App\Traits\ModelHasLogs;
use Illuminate\Database\Eloquent\Model;

class AuthModelProvider extends Model
{
    use ModelHasLogs;

    public $fillable = [
        'model_id',
        'model_type',
        'provider',
        'token',
        'expires_in',
        'refresh_token',
        'token_secret',
        'provider_id',
    ];
}
