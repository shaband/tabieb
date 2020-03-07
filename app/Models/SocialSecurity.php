<?php

namespace App\Models;

use App\Traits\ColumnTranslation;
use App\Traits\ModelHasLogs;
use Illuminate\Database\Eloquent\Model;

class SocialSecurity extends Model
{
    use ColumnTranslation,ModelHasLogs;
    protected $table = 'social_securities';
    public $timestamps = true;
    public $fillable = ['name_ar', 'name_en'];

    public function patient()
    {
        return $this->hasMany(Patient::class);
    }

}
