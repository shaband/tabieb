<?php

Route::group(['namespace' => 'Website\Patient', 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function () {

    Route::get('/', 'HomeController@index')->name('patient.dashboard');

    // Login
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('patient.login');
    Route::post('login', 'Auth\LoginController@login');
    Route::post('logout', 'Auth\LoginController@logout')->name('patient.logout');

    // Register
    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('patient.register');
    Route::post('register', 'Auth\RegisterController@register');
    // Passwords
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('patient.password.email');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('patient.password.request');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('patient.password.reset');

    // Verify
    Route::post('email/resend', 'Auth\VerificationController@resend')->name('patient.verification.resend');

    Route::get('email/verify', 'Auth\VerificationController@show')->name('patient.verification.notice');

    Route::get('email/verify/{id}/{hash}', 'Auth\VerificationController@verify')->name('patient.verification.verify');

    Route::middleware(['patient.auth'])->name('patient.')->group(function () {
        Route::get('profile', 'PatientController@edit')->name('profile.edit');
        Route::get('appointments', 'PatientController@myAppointment')->name('profile.appointments');
        Route::get('history', 'PatientController@myHistory')->name('profile.history');
        Route::get('change-password', 'PatientController@changePassword')->name('profile.change-password');
        Route::match(['put', 'patch', 'post'], 'profile', 'PatientController@update')->name('profile.update');

        Route::match(['put', 'patch', 'post'], 'patient-questions', 'PatientQuestionController@store');
        Route::get('medical-histories', 'MedicalHistoryController@index')->name('profile.medicalHistory');
        Route::post('medical-histories', 'MedicalHistoryController@store');

    });
});
