<?php
static $uri = 'users'; 
static $controller = 'User\UserController@'; 
Route::get($uri, $controller . 'index')->name('user.index');
Route::get($uri . '/profile/{user}', $controller . 'profile')->where(['user', '[0-9]+'])->name('user.perfil');
