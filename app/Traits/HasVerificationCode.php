<?php

namespace App\Traits;


use Illuminate\Database\Eloquent\Model;

trait  HasVerificationCode
{
    /**
     * Boot the has password trait for a model.
     *
     * @return void
     */
    public static function bootHasVerificationCode()
    {

        static::creating(function (Model $model) {

            $model->verification_code = randNumber();

        });


    }
}
