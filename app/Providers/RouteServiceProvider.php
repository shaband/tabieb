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
        $this->mapApiRoutes();

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
    protected function mapAdminRoutes()
    {
        Route::prefix('admin')
            ->middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/admin.php'));
    }

    /**
     * Define the "patient" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapPatientRoutes()
    {
        Route::prefix('patient')
            ->middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/patient.php'));
    }

    /**
     * Define the "doctor" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapDoctorRoutes()
    {
        Route::prefix('doctor')
            ->middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/doctor.php'));
    }

    /**
     * Define the "pharamacy_rep" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapPharamacyRepRoutes()
    {
        Route::prefix('pharamacyrep')
            ->middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/pharamacyrep.php'));
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace.'\Api')
            ->as('api.')
            ->group(base_path('routes/api.php'));
    }
}
