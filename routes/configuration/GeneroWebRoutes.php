<?php
static $uri = 'configurations/genders'; 
static $controller = 'Configuration\GeneroController@'; 
Route::get($uri, $controller . 'index')->name('genero.index');
