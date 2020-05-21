<?php

namespace App\Traits;

use App\Scopes\ImageScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

trait PushImage
{
    /**
     * Boot the has password trait for a model.
     *
     * @return void
     */
    public static function bootPushImage()
    {
        static::addGlobalScope(new ImageScope());

    }
}
