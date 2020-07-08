<?php

namespace App\Traits;


use Illuminate\Database\Eloquent\Model;
use Lcobucci\JWT\Builder;

trait  HasTransaction
{
    /**
     * Boot the has password trait for a model.
     *
     * @return void
     */
    public static function bootHasVerificationCode()
    {

        static::addGlobalScope('hasTransaction', function (Builder $builder) {
            $builder->has('transaction');
        });

    }
}
