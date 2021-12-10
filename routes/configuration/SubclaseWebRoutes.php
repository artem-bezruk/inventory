<?php
static $uri = 'configurations/subclasses'; 
static $controller = 'Configuration\SubclaseController@'; 
Route::get($uri, $controller . 'index')->name('subclase.index')->middleware('checkRol:sub_clases,r');
