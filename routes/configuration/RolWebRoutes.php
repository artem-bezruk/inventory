<?php
static $uri = 'configurations/roles'; 
static $controller = 'Configuration\RolController@'; 
Route::get($uri, $controller . 'index')->name('rol.index');
