<?php

Route::group(['namespace' => 'Website\Doctor', 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function () {

    Route::get('/', 'HomeController@index')->name('doctor.dashboard');

    // Login
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('doctor.login');
    Route::post('login', 'Auth\LoginController@login');
    Route::post('logout', 'Auth\LoginController@logout')->name('doctor.logout');

    // Register
    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('doctor.register');
    Route::post('register', 'Auth\RegisterController@register');

    // Passwords
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('doctor.password.email');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('doctor.password.request');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('doctor.password.reset');

    // Verify
    Route::post('email/resend', 'Auth\VerificationController@resend')->name('doctor.verification.resend');
    Route::get('email/verify', 'Auth\VerificationController@show')->name('doctor.verification.notice');
    Route::get('email/verify/{id}/{hash}', 'Auth\VerificationController@verify')->name('doctor.verification.verify');

    Route::middleware(['doctor.auth'])->name('doctor.')->group(function () {
        Route::get('profile', 'DoctorController@edit')->name('profile.edit');

        Route::get('change-password', 'DoctorController@changePassword')->name('profile.change-password');
        Route::match(['put', 'patch', 'post'], 'profile', 'DoctorController@update')->name('profile.update');
        Route::match(['get', 'post'], 'schedules', 'DoctorController@storeSchedule')->name('profile.schedules');

        Route::get('appointments', 'ReservationController@myAppointment')->name('profile.appointments');
        Route::get('requests', 'ReservationController@myRequests')->name('profile.requests');
        Route::put('appointment/status/{reservation_id}', 'ReservationController@updateStatus')->name('profile.status.update');
        Route::get('history', 'ReservationController@myHistory')->name('profile.history');
        Route::get('documents', 'AttachmentController@index')->name('profile.documents');
        Route::post('documents', 'AttachmentController@store');
        Route::delete('documents/{id}', 'AttachmentController@delete')->name('profile.documents.destroy');

        Route::get('appointment/{id}/medical-history', 'MedicalHistoryController@index')->name('medical-history');

        Route::get('chat/{chat_id?}', 'ChatController@inbox')->name('chat.inbox');


        Route::post('reservation/{reservation_id}/call', 'ReservationController@BeginCall')->name('reservation.rate');


        Route::get('prescription/{reservation_id}', 'PrescriptionController@show')->name('prescription.show');

        Route::get('prescription/{reservation_id}/create', 'PrescriptionController@create')->name('prescription.create');

        Route::post('prescription/{reservation_id}/create', 'PrescriptionController@store');

        Route::view('notifications', 'website.notifications')->name('notifications');
    });


});

/*Website\Doctor*/

Route::post('chat/{chat_id}/message', 'Website\Doctor\ChatController@addMessage')->middleware('doctor.auth')->name('doctor.chat.message');
