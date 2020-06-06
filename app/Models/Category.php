<?php

namespace App\Models;

use App\Traits\ColumnTranslation;
use App\Traits\ModelHasLogs;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{


    use ColumnTranslation, ModelHasLogs;
    protected $table = 'categories';
    public $timestamps = true;
    protected $fillable = array('name_ar', 'name_en', 'category_id', 'description_ar', 'description_en', 'blocked_at');

    public function doctors()
    {
        return $this->hasMany(Doctor::class, 'category_id');
    }

    public function sub_categories()
    {
        return $this->hasMany(Category::class, 'category_id');
    }

    public function main_category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    /*scope*/
    public function scopeMain(Builder $builder): void
    {
        $builder->whereNull('category_id');
    }

    public function scopeSub(Builder $builder): void
    {
        $builder->where('category_id', '!=', null);
    }
}
