<?php

namespace App\Models;

use App\Traits\ColumnTranslation;
use App\Traits\ModelHasLogs;
use Spatie\Permission\Models\Role as Model;

class Role extends Model
{
    use  ModelHasLogs;

    public function setLabelEnAttribute($value)
    {
        $this->attributes['name'] = $this->attributes['label_en'] = $value;
    }

    public function getLabelAttribute()
    {
        if (app()->getLocale() == 'ar') {
            return $this->label_ar;
        }
        return $this->label_en;
    }
}
