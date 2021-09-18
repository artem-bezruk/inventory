<?php
use Illuminate\Support\Facades\Route;
Route::get('lang/{lang}', function($lang) {
	\Session::put('lang', $lang);
	return \Redirect::back();
})->name('change_lang');
Route::get('/', function () {
    return view('layouts.home');
});
Auth::routes();
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/dashboard', 'HomeController@index')->name('dashboard');
