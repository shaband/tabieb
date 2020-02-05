<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialSecurity extends Model
{

    protected $table = 'social_securities';
    public $timestamps = true;

    public function patient()
    {
        return $this->hasMany('App\Models\Patient');
    }

}
