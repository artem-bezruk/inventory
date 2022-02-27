<?php
static $uri = 'properties'; 
static $controller = 'Bien\BienController@'; 
Route::get($uri, $controller . 'index')->name('bien.index')->middleware('checkRol:bienes,r');
Route::get($uri . '/create', $controller . 'create')->name('bien.create')->middleware('checkRol:bienes,c-r');
Route::post($uri, $controller . 'store')->name('bien.store')->middleware('checkRol:bienes,c-r');
Route::get($uri . '/list', $controller . 'bienes')->name('bien.list')->middleware('checkRol:bienes,r');
Route::get($uri. '/{bien}/show', $controller . 'show')->name('bien.show')->middleware('checkRol:bienes,r');
Route::get($uri . '/{bien}/edit', $controller . 'edit')->name('bien.edit')->middleware('checkRol:bienes,r-u');
Route::put($uri . '/{bien}', $controller . 'update')->name('bien.update')->middleware('checkRol:bienes,r-u');
