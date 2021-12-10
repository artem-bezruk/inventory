<?php
static $uri = 'configurations/nomenclatures'; 
static $controller = 'Configuration\NomenclaturaController@'; 
Route::get($uri, $controller . 'index')->name('nomenclatura.index')->middleware('checkRol:nomenclaturas,r');
