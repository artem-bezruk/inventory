<?php
static $uri = 'properties'; 
static $controller = 'Bien\BienController@'; 
Route::get($uri, $controller . 'index')->name('bien.index')->middleware('checkRol:bienes,r');
Route::get($uri . '/create', $controller . 'create')->name('bien.create')->middleware('checkRol:bienes,c-r');
Route::post($uri, $controller . 'store')->name('bien.store')->middleware('checkRol:bienes,c-r');
