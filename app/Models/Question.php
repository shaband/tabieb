<?php

namespace App\Models;

use App\Traits\ColumnTranslation;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use ColumnTranslation;
    protected $table = 'questions';
    public $timestamps = true;
    protected $fillable = array('name_ar', 'name_en', 'answer_ar', 'answer_en');

}