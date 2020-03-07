<?php

namespace App\Traits;


trait ColumnTranslation
{


    public function getNameAttribute()
    {
        if (app()->getLocale() == 'ar') {

            return $this->name_ar ?? $this->name_en;
        }
        return $this->name_en ?? $this->name_ar;

    }

    public function getDescriptionAttribute()
    {
        if (app()->getLocale() == 'ar') {
            return $this->description_ar;
        }
        return $this->description_en;
    }

    public function getAddressAttribute()
    {
        if (app()->getLocale() == 'ar') {
            return $this->address_ar;
        }
        return $this->address_en;
    }

    public function getGovernorateAttribute()
    {
        if (app()->getLocale() == 'ar') {
            return $this->governorate_ar;
        }
        return $this->governorate_en;
    }

    public function getCityAttribute()
    {
        if (app()->getLocale() == 'ar') {
            return $this->city_ar;
        }
        return $this->city_en;
    }

    public function getTermsAttribute()
    {
        if (app()->getLocale() == 'ar') {
            return $this->terms_ar;
        }
        return $this->terms_en;
    }

    public function getTitleAttribute()
    {
        if (app()->getLocale() == 'ar') {
            return $this->title_ar;
        }
        return $this->title_en;
    }

    public function getSlugAttribute()
    {
        if (app()->getLocale() == 'ar') {
            return $this->slug_ar;
        }
        return $this->slug_en;
    }
    public function getLabelAttribute()
    {
        if (app()->getLocale() == 'ar') {
            return $this->label_ar;
        }
        return $this->label_en;
    }
}
