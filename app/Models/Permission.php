<?php

namespace App\Models;

use App\Traits\ColumnTranslation;
use App\Traits\ModelHasLogs;
use Spatie\Permission\Models\Permission as Model;

class Permission extends Model
{

    use ModelHasLogs ;

    public function getLabelAttribute()
    {
        if (app()->getLocale() == 'ar') {
            return $this->label_ar;
        }
        return $this->label_en;
    }

}
