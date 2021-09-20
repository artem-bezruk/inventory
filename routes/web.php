<?php
use Illuminate\Support\Facades\Route;
Route::get('/', function () {
	return redirect(app()->getLocale() . '/home');
});
Route::group([ 'prefix' => '{locale}', 'where' => ['locale' => '[a-zA-Z]{2}'], 'middleware' => 'language' ], function () {
	Route::get('/home', function () {
		return view('layouts.home');
	})->name('home');
	Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
	Route::post('login', 'Auth\LoginController@login');
	Route::post('logout', 'Auth\LoginController@logout')->name('logout');
	Route::get('/dashboard', 'HomeController@index')->name('dashboard');
});
