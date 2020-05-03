<?php

namespace App\Providers;

use Illuminate\Broadcasting\BroadcastController;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\ServiceProvider;

class BroadcastServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Broadcast::routes(['middleware' => ['api', 'auth:patient_api'], 'prefix' => 'api/v1/patient']);
        Broadcast::routes(['middleware' => ['api', 'auth:doctor_api'], 'prefix' => 'api/v1/doctor']);
        Broadcast::routes(['middleware' => ['web', 'patient.auth'], 'prefix' => 'patient']);
        Broadcast::routes(['middleware' => ['web', 'doctor.auth'], 'prefix' => 'doctor']);


        require base_path('routes/channels.php');
    }


}
