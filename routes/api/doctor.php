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
Route::post('auth/verification/resend', 'AuthController@resendVerification');
Route::post('auth/profile', 'AuthController@Profile');


Route::middleware(['auth:doctor_api'])->group(function () {
    Route::post('reservations/upcoming', 'ReservationController@upcoming');
    Route::post('reservations/upcoming/type', 'ReservationController@ReservationsByType');

    Route::post('medical-histories', 'MedicalHistoryController@index');

    Route::post('reservations/action', 'ReservationController@changeReservationStatus');


    Route::post('reservations/prescription/create', 'PrescriptionController@create');
    Route::post('reservations/prescription', 'PrescriptionController@index');




    Route::post('chats', 'ChatController@inbox');
    Route::post('chats/create', 'ChatController@create');
    Route::post('chat/messages', 'ChatController@addMessage');


    Route::post('attachments', 'AttachmentController@index');
    Route::post('attachments/create', 'AttachmentController@create');
    Route::post('attachments/edit', 'AttachmentController@edit');
    Route::post('attachments/delete', 'AttachmentController@delete');

    Route::post('schedules', 'ScheduleController@index');
    Route::post('schedules/create', 'ScheduleController@create');
    Route::post('schedules/edit', 'ScheduleController@edit');
    Route::post('schedules/delete', 'ScheduleController@delete');
});

