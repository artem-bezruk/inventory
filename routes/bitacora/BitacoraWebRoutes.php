<?php
static $uri = 'binnacle'; 
static $controller = 'Bitacora\BitacoraController@'; 
Route::get($uri, $controller . 'index')->name('bitacora');
