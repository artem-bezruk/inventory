<?php
static $uri = 'configurations'; 
static $controller = 'Configuration\ConfigurationController@'; 
Route::get($uri, $controller . 'index')->name('config.index')->middleware('checkRol:configuraciones,r');
