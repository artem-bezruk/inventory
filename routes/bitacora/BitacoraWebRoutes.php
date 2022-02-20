<?php
static $uri = 'binnacle'; 
static $controller = 'Bitacora\BitacoraController@'; 
Route::get($uri, $controller . 'index')->name('bitacora')->middleware('checkRol:bitacora,r');
Route::get($uri . '/lista', $controller . 'lista')->name('bitacora.list')->middleware('checkRol:bitacora,r');
