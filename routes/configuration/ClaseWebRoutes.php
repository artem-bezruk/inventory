<?php
static $uri = 'configurations/classes'; 
static $controller = 'Configuration\ClaseController@'; 
Route::get($uri, $controller . 'index')->name('clase.index')->middleware('checkRol:clases,r');
Route::get($uri . '/create', $controller . 'create')->name('clase.create')->middleware('checkRol:clases,c-r');
Route::post($uri, $controller . 'store')->name('clase.store')->middleware('checkRol:clases,c-r');
Route::get($uri . '/list', $controller . 'clases')->name('clase.list')->middleware('checkRol:clases,r');
Route::get($uri. '/{clase}/show', $controller . 'show')->name('clase.show')->middleware('checkRol:clases,r');
Route::get($uri . '/{clase}/edit', $controller . 'edit')->name('clase.edit')->middleware('checkRol:clases,r-u');
Route::put($uri . '/{clase}', $controller . 'update')->name('clase.update')->middleware('checkRol:clases,r-u');
Route::delete($uri . '/{clase}', $controller . 'destroy')->name('clase.destroy')->middleware('checkRol:clases,r-d');
