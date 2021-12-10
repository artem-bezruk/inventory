<?php
static $uri = 'configurations/classes'; 
static $controller = 'Configuration\ClaseController@'; 
Route::get($uri, $controller . 'index')->name('clase.index')->middleware('checkRol:clases,r');
