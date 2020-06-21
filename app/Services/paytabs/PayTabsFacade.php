<?php


namespace App\Services\paytabs;

use  Illuminate\Support\Facades\Facade;

class PayTabsFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'payTabs';
    }

}
