<?php

namespace App\Models;

use App\Traits\ColumnTranslation;
use App\Traits\ModelHasLogs;
use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    use ColumnTranslation,ModelHasLogs;
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
