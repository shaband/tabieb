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
Route::post('auth/social/login', 'AuthController@socialLogin');
Route::post('auth/logout', 'AuthController@logout');
Route::post('auth/verify', 'AuthController@verify');
Route::post('auth/profile', 'AuthController@Profile');
Route::post('auth/verification/resend', 'AuthController@resendVerification');

Route::post('auth/reset-password/send', 'AuthController@sendResetPassCode');
Route::post('auth/reset-password', 'AuthController@resetPassword');


Route::post('home', 'DoctorController@index');
Route::post('category/doctors', 'DoctorController@doctorsInCategory');
Route::post('doctors/search', 'DoctorController@search');
Route::get('categories', 'CategoryController@index');

Route::middleware(['auth:patient_api'])->group(function () {

    Route::post('reservations/create', 'ReservationController@create');
    Route::post('reservations/confirm-transactions', 'ReservationController@confirmTransaction');
    Route::post('reservations/cancel', 'ReservationController@cancel');
    Route::post('reservations/upcoming', 'ReservationController@upcoming');
    Route::post('reservations/previous', 'ReservationController@previous');
    Route::post('reservation', 'ReservationController@reservation');
    Route::post('reservation/rate', 'RatingController@create');
    Route::post('reservation/prescription', 'PrescriptionController@show');
    Route::post('prescriptions', 'PrescriptionController@index');
    Route::post('chats', 'ChatController@inbox');
    Route::post('chats/create', 'ChatController@create');
    Route::post('chat/messages', 'ChatController@addMessage');
    Route::post('patient-questions', 'PatientQuestionController@questions');
    Route::post('patient-questions/create', 'PatientQuestionController@answers');
    Route::post('patient-questions/answers', 'PatientQuestionController@patientAnswers');


    Route::post('medical-histories', 'MedicalHistoryController@index');
    Route::post('medical-histories/create', 'MedicalHistoryController@store');
    Route::post('medical-histories/update', 'MedicalHistoryController@update');
    Route::post('medical-histories/delete', 'MedicalHistoryController@destroy');

    Route::post('favourites', 'FavouriteController@index');
    Route::post('favourites/toggle', 'FavouriteController@toggleFavourite');

});

