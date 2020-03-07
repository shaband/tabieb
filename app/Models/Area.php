<?php

namespace App\Models;

use App\Traits\ColumnTranslation;
use App\Traits\ModelHasLogs;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use ColumnTranslation,ModelHasLogs;
    protected $table = 'areas';
    public $timestamps = true;
    protected $fillable = array('name_ar', 'name_en', 'district_id', 'blocked_at');

    public function blocks()
    {
        return $this->hasMany(Block::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

}
