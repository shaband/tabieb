<?php

namespace App\Providers;

use App\Models\Admin;
use App\Models\Doctor;
use App\Models\MedicalHistory;
use App\Models\Message;
use App\Models\Patient;
use App\Models\Pharmacy;
use App\Models\PharmacyRep;
use App\Models\Prescription;
use App\Observers\prescriptionObserver;
use App\Observers\PushMessageNotificationObserver;
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
            'pharmacies' => Pharmacy::class,
            'Pharmacy_reps' => PharmacyRep::class,
            'medical_histories' => MedicalHistory::class,
        ]);

        Prescription::observe(prescriptionObserver::class);
      //  Message::observe(PushMessageNotificationObserver::class);
    }
}
