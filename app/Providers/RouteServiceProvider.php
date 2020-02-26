<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';


    /**
     * The path to the "home" route for your application.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {

        //api
        $this->mapApiRoutes();
        $this->mapPatientApiRoutes();
        $this->mapDoctorApiRoutes();

        //web
        $this->mapWebRoutes();
        $this->mapPharamacyRepRoutes();
        $this->mapDoctorRoutes();
        $this->mapPatientRoutes();
        $this->mapAdminRoutes();


        //
    }

    /**
     * Define the "admin" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapAdminRoutes(): void
    {
        Route::prefix('admin')
            ->middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web/admin.php'));
    }

    /**
     * Define the "patient" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapPatientRoutes(): void
    {
        Route::prefix('patient')
            ->middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web/patient.php'));
    }

    /**
     * Define the "doctor" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapDoctorRoutes(): void
    {
        Route::prefix('doctor')
            ->middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web/doctor.php'));
    }

    /**
     * Define the "pharamacy_rep" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapPharamacyRepRoutes(): void
    {
        Route::prefix('pharamacyrep')
            ->middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web/pharamacyrep.php'));
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes(): void
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes(): void
    {
        Route::prefix('api/v1')
            ->middleware('api')
            ->namespace($this->namespace . '\Api\v1')
            ->as('api.')
            ->group(base_path('routes/api/api.php'));
    }

    /**
     * Define the "api patient" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapPatientApiRoutes(): void
    {
        Route::prefix('api/v1/patient')
            ->middleware(['api', 'apiLocalization'])
            ->namespace($this->namespace . '\Api\v1\Patient')
            ->as('api.patient.')
            ->group(base_path('routes/api/patient.php'));
    }

    /**
     * Define the "api doctor" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapDoctorApiRoutes(): void
    {
        Route::prefix('api/v1/doctor')
            ->middleware(['api', 'apiLocalization'])
            ->namespace($this->namespace . '\Api\v1\Doctor')
            ->as('api.doctor.')
            ->group(base_path('routes/api/doctor.php'));
    }
}
