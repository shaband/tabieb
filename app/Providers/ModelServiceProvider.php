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
use App\Models\Reservation;
use App\Observers\PrescriptionObserver;
use App\Observers\PushMessageNotificationObserver;
use App\Services\Drivers\PayTabService;
use App\Services\paytabs\PayTabs;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\App;
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

        App::bind('payTabs',function() {
            return new PayTabs();
        });
        App::bind('payTabsService',function() {
            return new PayTabService();
        });
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
            'prescriptions' => Prescription::class,
            'reservations' => Reservation::class,
        ]);

        Prescription::observe(PrescriptionObserver::class);
        //  Message::observe(PushMessageNotificationObserver::class);
    }
}
