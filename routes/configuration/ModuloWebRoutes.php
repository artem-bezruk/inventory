<?php
static $uri = 'configurations/modules'; 
static $controller = 'Configuration\ModuloController@'; 
Route::get($uri, $controller . 'index')->name('modulo.index');
