<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{

    protected $table = 'areas';
    public $timestamps = true;
    protected $fillable = array('district_id', 'blocked_at');

    public function blocks()
    {
        return $this->hasMany(Blocks::class);
    }

    public function district()
    {
        return $this->belongsTo(Distrcit::class);
    }

}
