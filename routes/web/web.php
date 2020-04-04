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
Route::group(['prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
    'namespace'=>'Website'
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

});
Route::get('/test', 'HomeController@test');

