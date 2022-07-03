<?php
static $uri = 'configurations/estatus'; 
static $controller = 'Configuration\EstatuController@'; 
Route::get($uri, $controller . 'index')->name('estatu.index')->middleware('checkRol:estatus,r');
Route::get($uri . '/create', $controller . 'create')->name('estatu.create')->middleware('checkRol:estatus,c-r');
Route::post($uri, $controller . 'store')->name('estatu.store')->middleware('checkRol:estatus,c-r');
Route::get($uri . '/list', $controller . 'estatus')->name('estatu.list')->middleware('checkRol:estatus,r');
Route::get($uri. '/{estatu}/show', $controller . 'show')->name('estatu.show')->middleware('checkRol:estatus,r');
Route::get($uri . '/{estatu}/edit', $controller . 'edit')->name('estatu.edit')->middleware('checkRol:estatus,r-u');
Route::put($uri . '/{estatu}', $controller . 'update')->name('estatu.update')->middleware('checkRol:estatus,r-u');
Route::delete($uri . '/{estatu}', $controller . 'destroy')->name('estatu.destroy')->middleware('checkRol:estatus,r-d');
