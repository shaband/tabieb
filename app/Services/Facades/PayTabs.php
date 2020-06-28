<?php


namespace App\Services\Facades;


use Illuminate\Support\Facades\Facade;

class PayTabs extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'payTabsService';
    }

}
