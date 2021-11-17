<?php
static $uri = 'configurations/modulesbyroles'; 
static $controller = 'Configuration\ModuloHasRolController@'; 
Route::get($uri, $controller . 'index')->name('modulorol.index');
