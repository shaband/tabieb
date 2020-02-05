<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{

    protected $table = 'districts';
    public $timestamps = true;
    protected $fillable = array('name_ar', 'name_en', 'blocked_at');

    public function area()
    {
        return $this->hasMany(Area::class);
    }

    public function patients()
    {
        return $this->hasMany(Patient::class);
    }

}
