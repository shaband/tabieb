<?php

namespace App\Models;

use App\Traits\ColumnTranslation;
use App\Traits\HasVerificationCode;
use App\Traits\ModelHasImage;
use App\Traits\ModelHasLogs;
use Illuminate\Database\Eloquent\Model;

class Pharmacy extends Model
{

    use ColumnTranslation,HasVerificationCode,ModelHasImage,ModelHasLogs;
    protected $table = 'pharmacies';
    public $timestamps = true;
    protected $fillable = array('name_ar', 'name_en', 'phone', 'address_ar', 'address_en', 'district_id', 'area_id', 'block_id', 'email', 'email_verified_at', 'phone_verified_at', 'verification_code', 'blocked_at', 'blocked_reason');

    public function district()
    {
        return $this->belongsTo('App\Models\District');
    }

    public function area()
    {
        return $this->belongsTo('App\Models\Area');
    }

    public function block()
    {
        return $this->belongsTo('App\Models\Block');
    }

    public function reps()
    {
        return $this->hasMany('App\Models\PharamacyRep');
    }

    public function prescription()
    {
        return $this->hasMany('App\Models\Prescription');
    }

}
