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
Route::get('categories/{category}/sub-categories', 'CategoryController@getSubCategoriesForMainCategory')->name('categories.sub-categories');



Route::post('districts', 'DistrictController@index');
Route::post('areas', 'AreaController@index');
Route::post('district/areas', 'AreaController@areasInDistrict')->name('district.areas');
Route::post('blocks', 'BlockController@index');
Route::post('area/blocks', 'BlockController@blocksInArea')->name('area.blocks');
Route::post('social-securities', 'SocialSecurityController@index');


Route::post('home', 'DoctorController@index');
Route::post('category/doctors', 'DoctorController@doctorsInCategory');
Route::post('doctors/search', 'DoctorController@search');
Route::get('categories', 'CategoryController@index');


Route::post('contact', 'ContactController@send');

Route::post('setting/{name}', 'SettingController@index');
