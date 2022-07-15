<?php
static $uri = 'configurations/genders'; 
static $controller = 'Configuration\GeneroController@'; 
Route::get($uri, $controller . 'index')->name('genero.index')->middleware('checkRol:generos,r');
Route::get($uri . '/create', $controller . 'create')->name('genero.create')->middleware('checkRol:generos,c-r');
Route::post($uri, $controller . 'store')->name('genero.store')->middleware('checkRol:generos,c-r');
Route::get($uri . '/list', $controller . 'generos')->name('genero.list')->middleware('checkRol:generos,r');
Route::get($uri. '/{genero}/show', $controller . 'show')->name('genero.show')->middleware('checkRol:generos,r');
Route::get($uri . '/{genero}/edit', $controller . 'edit')->name('genero.edit')->middleware('checkRol:generos,r-u');
Route::put($uri . '/{genero}', $controller . 'update')->name('genero.update')->middleware('checkRol:generos,r-u');
Route::delete($uri . '/{genero}', $controller . 'destroy')->name('genero.destroy')->middleware('checkRol:generos,r-d');
