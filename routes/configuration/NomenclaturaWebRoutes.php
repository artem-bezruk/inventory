<?php
static $uri = 'configurations/nomenclatures'; 
static $controller = 'Configuration\NomenclaturaController@'; 
Route::get($uri, $controller . 'index')->name('nomenclatura.index')->middleware('checkRol:nomenclaturas,r');
Route::get($uri . '/create', $controller . 'create')->name('nomenclatura.create')->middleware('checkRol:nomenclaturas,c-r');
Route::post($uri, $controller . 'store')->name('nomenclatura.store')->middleware('checkRol:nomenclaturas,c-r');
Route::get($uri . '/list', $controller . 'nomenclaturas')->name('nomenclatura.list')->middleware('checkRol:nomenclaturas,r');
Route::get($uri. '/{nomenclatura}/show', $controller . 'show')->name('nomenclatura.show')->middleware('checkRol:nomenclaturas,r');
Route::get($uri . '/{nomenclatura}/edit', $controller . 'edit')->name('nomenclatura.edit')->middleware('checkRol:nomenclaturas,r-u');
Route::put($uri . '/{nomenclatura}', $controller . 'update')->name('nomenclatura.update')->middleware('checkRol:nomenclaturas,r-u');
Route::delete($uri . '/{nomenclatura}', $controller . 'destroy')->name('nomenclatura.destroy')->middleware('checkRol:nomenclaturas,r-d');
