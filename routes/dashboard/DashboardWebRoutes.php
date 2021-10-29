<?php
static $uri = 'dashboard'; 
static $controller = 'Dashboard\DashboardController@'; 
Route::get($uri, $controller . 'index')->name('dashboard');
