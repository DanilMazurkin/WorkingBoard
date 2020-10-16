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
		Route::get('/profile/{id}', "ProfileController@index")->name('profile');
		Route::post('/profile/{id}', "ProfileController@setFio")->name('profile_fio');
		Route::patch('/profile/{id}', "ProfileController@updateData")->name('profile_set');
	});

});