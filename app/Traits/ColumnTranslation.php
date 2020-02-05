<?php

namespace App\Traits;


trait ColumnTranslation
{


    public function getNameAttribute()
    {
        if (app()->getLocale() == 'ar') {

            return $this->name_ar;
        }
        return $this->name_en;

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
}
