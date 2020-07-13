<?php

Route::group([
    'namespace' => 'Website\PharmacyRep',
    'middleware' =>
        ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function () {


    Route::get('/', 'HomeController@index')->name('pharmacy.dashboard');

    // Login
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('pharmacy.login');
    Route::post('login', 'Auth\LoginController@login');
    Route::post('logout', 'Auth\LoginController@logout')->name('pharmacy.logout');

    // Register
    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('pharmacy.register');
    Route::post('register', 'Auth\RegisterController@register');

    // Passwords
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('pharmacy.password.email');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('pharmacy.password.request');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('pharmacy.password.reset');

    // Verify
    Route::post('email/resend', 'Auth\VerificationController@resend')->name('pharmacy.verification.resend');
    Route::get('email/verify', 'Auth\VerificationController@show')->name('pharmacy.verification.notice');
    Route::get('email/verify/{id}/{hash}', 'Auth\VerificationController@verify')->name('pharmacy.verification.verify');


    Route::middleware(['pharmacy_rep.auth:pharmacy_rep'])->name('pharmacy.')->group(function () {
        Route::resource('pharmacy-reps', 'PharmacyRepController')->middleware('pharmacy.manger');
        Route::resource('prescriptions', 'PrescriptionController')->only('index', 'show')->middleware('pharmacy.manger');


        Route::get('prescription/search', 'PrescriptionController@search')->name('prescriptions.search');
        Route::match(['post', 'patch', 'post'], 'prescriptions/{id}/finish', 'PrescriptionController@FinishPrescription')->name('prescription.finish');


    });

});
