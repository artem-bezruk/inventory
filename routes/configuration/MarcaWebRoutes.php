<?php
static $uri = 'configurations/marks'; 
static $controller = 'Configuration\MarcaController@'; 
Route::get($uri, $controller . 'index')->name('marca.index')->middleware('checkRol:marcas,r');
Route::get($uri . '/create', $controller . 'create')->name('marca.create')->middleware('checkRol:marcas,c-r');
Route::post($uri, $controller . 'store')->name('marca.store')->middleware('checkRol:marcas,c-r');
Route::get($uri . '/list', $controller . 'marcas')->name('marca.list')->middleware('checkRol:marcas,r');
Route::get($uri. '/{marca}/show', $controller . 'show')->name('marca.show')->middleware('checkRol:marcas,r');
Route::get($uri . '/{marca}/edit', $controller . 'edit')->name('marca.edit')->middleware('checkRol:marcas,r-u');
Route::put($uri . '/{marca}', $controller . 'update')->name('marca.update')->middleware('checkRol:marcas,r-u');
Route::delete($uri . '/{marca}', $controller . 'destroy')->name('marca.destroy')->middleware('checkRol:marcas,r-d');
