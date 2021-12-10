<?php
static $uri = 'properties'; 
static $controller = 'Bien\BienController@'; 
Route::get($uri, $controller . 'index')->name('bien.index')->middleware('checkRol:bienes,r');
