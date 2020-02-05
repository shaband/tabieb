<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{

    protected $table = 'settings';
    public $timestamps = true;
    protected $fillable = array('name', 'slug_ar', 'slug_en', 'value', 'input_type', 'category');

}
