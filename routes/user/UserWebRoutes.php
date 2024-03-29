<?php
static $uri = 'users'; 
static $controller = 'User\UserController@'; 
Route::get($uri, $controller . 'index')->name('user.index')->middleware('checkRol:users,r');
Route::get($uri . '/create', $controller . 'create')->name('user.create')->middleware('checkRol:users,c-r');
Route::post($uri, $controller . 'store')->name('user.store')->middleware('checkRol:users,c-r');
Route::get($uri . '/profile', $controller . 'profile')->name('user.perfil')->middleware('checkRol:users_perfil,r-u');
Route::get($uri . '/list', $controller . 'users')->name('user.list')->middleware('checkRol:users,r');
Route::get($uri . '/{user}/show', $controller . 'show')->name('user.show')->middleware('checkRol:users,r');
Route::get($uri . '/{user}/edit', $controller . 'edit')->name('user.edit')->middleware('checkRol:users,r-u');
Route::put($uri . '/{user}', $controller . 'update')->name('user.update')->middleware('checkRol:users,r-u');
Route::delete($uri . '/{user}', $controller . 'destroy')->name('user.destroy')->middleware('checkRol:users,r-d');
