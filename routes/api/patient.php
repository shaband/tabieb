<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('auth/register', 'AuthController@register');
Route::post('auth/login', 'AuthController@login');
Route::post('auth/logout', 'AuthController@logout');
Route::post('auth/verify', 'AuthController@verify');
Route::post('auth/profile', 'AuthController@Profile');


Route::post('districts', 'DistrictController@index');
Route::post('areas', 'AreaController@index');
Route::post('district/areas', 'AreaController@areasInDistrict');
Route::post('blocks', 'BlockController@index');
Route::post('area/blocks', 'BlockController@blocksInArea');
Route::post('social-securities', 'SocialSecurityController@index');


Route::post('home', 'DoctorController@index');
Route::post('category/doctors', 'DoctorController@doctorsInCategory');
Route::post('doctors/search', 'DoctorController@search');
Route::get('categories', 'CategoryController@index');

Route::middleware(['auth:patient_api'])->group(function () {

    Route::post('reservations/create', 'ReservationController@create');
    Route::post('reservations/cancel', 'ReservationController@cancel');

    Route::post('reservations/upcoming', 'ReservationController@upcoming');
    Route::post('reservations/previous', 'ReservationController@previous');
    Route::post('reservation', 'ReservationController@reservation');
    Route::post('reservation/rate', 'RatingController@create');
    Route::post('reservation/prescription', 'PrescriptionController@index');


    Route::post('chats', 'ChatController@inbox');
    Route::post('chats/create', 'ChatController@create');
    Route::post('chat/messages', 'ChatController@addMessage');
});

