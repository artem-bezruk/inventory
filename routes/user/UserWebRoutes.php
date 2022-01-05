<?php
static $uri = 'users'; 
static $controller = 'User\UserController@'; 
Route::get($uri, $controller . 'index')->name('user.index')->middleware('checkRol:users,r');
Route::get($uri . '/{user}/profile', $controller . 'profile')->where(['user', '[0-9]+'])->name('user.perfil')->middleware('checkRol:users_perfil,r-u');
Route::get($uri . '/all', $controller . 'users')->name('user.list')->middleware('checkRol:users,r');
Route::get($uri . '/{user}/show', $controller . 'show')->where(['user', '[0-9]+'])->name('user.show')->middleware('checkRol:users,r');
