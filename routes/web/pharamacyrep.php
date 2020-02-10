<?php

Route::group(['namespace' => 'PharamacyRep'], function() {

    Route::get('/', 'HomeController@index')->name('pharamacyrep.dashboard');

    // Login
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('pharamacyrep.login');
    Route::post('login', 'Auth\LoginController@login');
    Route::post('logout', 'Auth\LoginController@logout')->name('pharamacyrep.logout');

    // Register
    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('pharamacyrep.register');
    Route::post('register', 'Auth\RegisterController@register');

    // Passwords
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('pharamacyrep.password.email');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('pharamacyrep.password.request');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('pharamacyrep.password.reset');

    // Verify
    Route::post('email/resend', 'Auth\VerificationController@resend')->name('pharamacyrep.verification.resend');
    Route::get('email/verify', 'Auth\VerificationController@show')->name('pharamacyrep.verification.notice');
    Route::get('email/verify/{id}/{hash}', 'Auth\VerificationController@verify')->name('pharamacyrep.verification.verify');

});
