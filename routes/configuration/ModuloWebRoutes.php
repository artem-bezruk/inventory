<?php
static $uri = 'configurations/modules'; 
static $controller = 'Configuration\ModuloController@'; 
Route::get($uri, $controller . 'index')->name('modulo.index')->middleware('checkRol:modulos,r');
Route::get($uri . '/create', $controller . 'create')->name('modulo.create')->middleware('checkRol:modulos,c-r');
Route::post($uri, $controller . 'store')->name('modulo.store')->middleware('checkRol:modulos,c-r');
Route::get($uri . '/list', $controller . 'modulos')->name('modulo.list')->middleware('checkRol:modulos,r');
Route::get($uri. '/{modulo}/show', $controller . 'show')->name('modulo.show')->middleware('checkRol:modulos,r');
Route::get($uri . '/{modulo}/edit', $controller . 'edit')->name('modulo.edit')->middleware('checkRol:modulos,r-u');
Route::put($uri . '/{modulo}', $controller . 'update')->name('modulo.update')->middleware('checkRol:modulos,r-u');
Route::delete($uri . '/{modulo}', $controller . 'destroy')->name('modulo.destroy')->middleware('checkRol:modulos,r-d');
