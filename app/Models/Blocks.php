<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blocks extends Model
{

    protected $table = 'blocks';
    public $timestamps = true;
    protected $fillable = array('name_ar','name_en','area_id', 'blocked_at');

    public function patients()
    {
        return $this->hasMany(Patient::class);
    }

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

}
