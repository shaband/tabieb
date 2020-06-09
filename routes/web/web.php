<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Models\Patient;
use App\Notifications\PrescriptionAdded;

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
    'namespace' => 'Website'
], function () {

    Route::get('/', 'HomeController@index');

    try {
        view()->share('settings', \App\Models\Setting::pluck('value', 'name'));
    } catch (Exception $e) {
    }
    Route::get('/home', 'HomeController@index')->name('home');
    Route::view('/about', 'website.about')->name('about');
    Route::view('/policy', 'website.policy')->name('policy');
    Route::view('/contact', 'website.contact')->name('contact.show');
    Route::post('/contact', 'ContactController@send')->name('contact.send');
    Route::get('/appointment/search', 'ReservationController@search')->name('reservation.search');
    Route::get('/profile/{id}/doctor', 'ReservationController@doctorProfile')->name('reservation.doctor');
    Route::get('/certifications/{id}/doctor', 'ReservationController@doctorCertifications')->name('reservation.doctor.certification');

    //just for  نمشى الشغل  لسه فيه ال biling يارب العميل ينجز
    //TODO::show biling form  with comming data  and remove  reserve direct
    Route::get('reservation/reserve', 'ReservationController@createWithoutBilling')->name('reservation.reserve')->middleware(['patient.auth']);

    Route::match(['get', 'post'], '/quick-call', 'ReservationController@QuickCall')->middleware(['patient.auth'])->name('quick-call');
    Route::match(['get', 'post'], '/quick-call/response/{reservation_id}', 'ReservationController@QuickCall')->middleware(['doctor.auth'])->name('quick-call.accept');
    Route::match(['get', 'post'], '/quick-call/respond', 'ReservationController@QuickCallRespond')->middleware(['doctor.auth'])->name('quick-call.respond');
});
Route::get('/test', 'HomeController@test');


/*social login*/
Route::get('auth/{provider}/login', 'Auth\SocialController@redirectToProvider')->name('social.login');
Route::get('auth/{provider}/callback', 'Auth\SocialController@handleProviderCallback');

Route::get('push', function () {
    $user = Socialite::driver('facebook')->userFromToken("EAAJRRXoLxYgBAOcHgxftNpDfOqkX2zUuDgW9ejeLMEe70NWB0675TH8GbTZCWwhUtIowshINifVNEmFUU7NQCDRe9JLPqj9L6RV0cXoYz0J6rmywsJEfJwwmHS2j1RjzLlluTWlTJ1dfjDOtZCVLsm3ljXGOLVlwEugYlXYMMbZCEZCWee1x");

    dd($user);

});
