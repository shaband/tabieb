<?php

Route::group(['namespace' => 'Admin', 'as' => 'admin.'], function () {


    // Login
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@login');
    Route::post('logout', 'Auth\LoginController@logout')->name('logout');

    // Passwords
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');

    // Verify
    Route::post('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');
    Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
    Route::get('email/verify/{id}/{hash}', 'Auth\VerificationController@verify')->name('verification.verify');
    Route::middleware(['admin.auth:admin'])->group(function () {
        Route::get('/', 'HomeController@index')->name('dashboard');
        Route::resource('admins', 'AdminController');
        Route::resource('categories', 'CategoryController');
    });
});
