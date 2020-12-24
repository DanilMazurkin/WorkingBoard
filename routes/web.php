<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('auth/google', 'Auth\LoginController@redirectToGoogle');
Route::get('auth/google/callback', 'Auth\LoginController@handleGoogleCallback'); 


Route::group(['namespace' => 'UserController'], function () {
	
	Route::middleware(['auth'])->group(function () {
		
		Route::get('/profile/{user}', "ProfileController@index")->name('profile');
		Route::post('/profile', "ProfileController@setFio")->name('profile_fio');
		Route::post('/profile/number', "ProfileController@setPhoneNumber")->name('number_phone_set');
		Route::patch('/profile', "ProfileController@setAvatar")->name('profile_update');

		Route::get('/ad', "AdController@create")->name('create_ad_form');
		Route::post('/ad', "AdController@store")->name('store_ad_form');

		Route::get('/getdata/{id}', "ProfileController@getDataUser")->name('get_data_user');

		Route::get('/ads/{id}', "AdController@show")->name('view_ads');
		Route::get('/new/ads', "AdController@newAds")->name('view_new_ads');
	});

});

