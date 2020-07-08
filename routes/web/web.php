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
        $settings = cache()->remember('settings', 60 * 60 , function () {
            return \App\Models\Setting::pluck('value', 'name');
        });
        view()->share('settings', $settings);
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
    Route::post('reservation/reserve', 'ReservationController@reserve')->name('reservation.reserve')->middleware(['patient.auth']);

    Route::match(['get', 'post'], '/quick-call', 'ReservationController@QuickCall')->middleware(['patient.auth'])->name('quick-call');
    Route::match(['get', 'post'], '/quick-call/response/{reservation_id}', 'ReservationController@QuickCall')->middleware(['doctor.auth'])->name('quick-call.accept');
    Route::match(['get', 'post'], '/quick-call/respond', 'ReservationController@receiveCall')->middleware(['doctor.auth'])->name('quick-call.respond');
});
Route::get('/test', 'HomeController@test');


/*social login*/
Route::get('auth/{provider}/login', 'Auth\SocialController@redirectToProvider')->name('social.login');
Route::get('auth/{provider}/callback', 'Auth\SocialController@handleProviderCallback');


Route::get('pay', function () {

    $patient = Patient::find(6);
    $reservation = $patient->reservations()->doesnthave('transaction')->first();

    $price = $reservation->doctor->price;
    $reference = $reservation->id;
    $checkout = \App\Services\Facades\PayTabs::Checkout($patient, $price, $reference);

    if ($checkout['response_code'] == 4012) {
        return redirect($checkout['payment_url']);
    } else {
        Log::error($checkout["result"], $checkout);
        throw \Illuminate\Validation\ValidationException::withMessages([$checkout["result"]]);
    }
    //    dd($patient);

});

Route::post('paytabs/callback','Website\Patient\TransactionController@reservationCallback')->middleware(['patient.auth'])->name('patient.reservation.transaction');
Route::post('paytabs/quick-call/callback','Website\Patient\TransactionController@quickCallCallback')->middleware(['patient.auth'])->name('patient.quick-call.transaction');
