<?php

namespace App\Providers;

use App\Models\Admin;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Pharmacy;
use App\Models\PharmacyRep;
use App\Models\Prescription;
use App\Observers\prescriptionObserver;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class ModelServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Relation::morphMap([
            'admins' => Admin::class,
            'doctors' => Doctor::class,
            'patients' => Patient::class,
            'pharmacies'=>Pharmacy::class,
            'Pharmacy_reps'=>PharmacyRep::class,
        ]);

        Prescription::observe(prescriptionObserver::class);
    }
}
