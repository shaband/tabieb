<?php

namespace App\Models;

use App\Traits\ColumnTranslation;
use App\Traits\ModelHasLogs;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{

    use  ColumnTranslation, ModelHasLogs;
    const INPUT_TEXT = 0;
    const INPUT_NUMBER = 1;
    const INPUT_TEXTAREA = 2;
    const INPUT_TYPE_EMAIL = 3;


    const CATEGORY_PAGES = 1;
    const CATEGORY_HOME_SECTIONS = 2;
    const CATEGORY_FOOTER = 3;
    const CATEGORY_CONTACT = 4;


    protected $table = 'settings';
    public $timestamps = true;
    protected $fillable = array('name', 'slug_ar', 'slug_en', 'value', 'input_type', 'category');


    public function getNameAttribute()
    {
        return $this->attributes['name'];
    }
}
