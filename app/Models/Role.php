<?php

namespace App\Models;

use App\Traits\ColumnTranslation;
use App\Traits\ModelHasLogs;
use Spatie\Permission\Models\Role as Model;

class Role extends Model
{
    use  ModelHasLogs, ColumnTranslation;

    public function setLabelEnAttribute($value)
    {
        $this->attributes['name'] = $this->attributes['label_en'] = $value;

    }
}
