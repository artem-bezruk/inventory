<?php
static $uri = 'configurations/roles'; 
static $controller = 'Configuration\RolController@'; 
Route::get($uri, $controller . 'index')->name('rol.index')->middleware('checkRol:roles,r');
Route::get($uri . '/create', $controller . 'create')->name('rol.create')->middleware('checkRol:roles,c-r');
Route::post($uri, $controller . 'store')->name('rol.store')->middleware('checkRol:roles,c-r');
Route::get($uri . '/list', $controller . 'roles')->name('rol.list')->middleware('checkRol:roles,r');
Route::get($uri. '/{rol}/show', $controller . 'show')->name('rol.show')->middleware('checkRol:roles,r');
Route::get($uri . '/{rol}/edit', $controller . 'edit')->name('rol.edit')->middleware('checkRol:roles,r-u');
Route::put($uri . '/{rol}', $controller . 'update')->name('rol.update')->middleware('checkRol:roles,r-u');
Route::delete($uri . '/{rol}', $controller . 'destroy')->name('rol.destroy')->middleware('checkRol:roles,r-d');
