<?php

namespace App\Providers;

use App\Services\Contracts\TokBoxContract;
use App\Services\Drivers\TokBoxDriver;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('path.public', function () {
            return base_path() . '/public_html';
        });



    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Gate::before(function ($user, $ability) {
            return $user->id == 1;
        });

        $this->app->bind(TokBoxContract::class, TokBoxDriver::class);


    }
}
