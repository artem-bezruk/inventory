<?php
use Illuminate\Support\Facades\Route;
Route::get('/', function () {
    return view('welcome');
});
Auth::routes();
Route::get('/dashboard', 'HomeController@index')->name('dashboard');
