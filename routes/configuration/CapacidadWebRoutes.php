<?php
static $uri = 'configurations/capacities'; 
static $controller = 'Configuration\CapacidadController@'; 
Route::get($uri, $controller . 'index')->name('capacidad.index')->middleware('checkRol:capacidades,r');
Route::get($uri . '/create', $controller . 'create')->name('capacidad.create')->middleware('checkRol:capacidades,c-r');
Route::post($uri, $controller . 'store')->name('capacidad.store')->middleware('checkRol:capacidades,c-r');
Route::get($uri . '/list', $controller . 'capacidades')->name('capacidad.list')->middleware('checkRol:capacidades,r');
Route::get($uri. '/{capacidad}/show', $controller . 'show')->name('capacidad.show')->middleware('checkRol:capacidades,r');
Route::get($uri . '/{capacidad}/edit', $controller . 'edit')->name('capacidad.edit')->middleware('checkRol:capacidades,r-u');
Route::put($uri . '/{capacidad}', $controller . 'update')->name('capacidad.update')->middleware('checkRol:capacidades,r-u');
Route::delete($uri . '/{capacidad}', $controller . 'destroy')->name('capacidad.destroy')->middleware('checkRol:capacidades,r-d');
