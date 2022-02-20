<?php
static $uri = 'configurations/subclasses'; 
static $controller = 'Configuration\SubclaseController@'; 
Route::get($uri, $controller . 'index')->name('subclase.index')->middleware('checkRol:sub_clases,r');
Route::get('subclasses/{clase}', $controller . 'subclases')->where(['clase' => '[0-9]+'])->name('subclases')->middleware('checkRol:bienes,c');
