<?php

namespace App\Models;

use App\Traits\ColumnTranslation;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{

    use ColumnTranslation;
    protected $table = 'districts';
    public $timestamps = true;
    protected $fillable = array('name_ar', 'name_en', 'blocked_at');

    public function areas()
    {
        return $this->hasMany(Area::class);
    }

    public function patients()
    {
        return $this->hasMany(Patient::class);
    }

}
