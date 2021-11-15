<?php
static $uri = 'configurations/marks'; 
static $controller = 'Configuration\MarcaController@'; 
Route::get($uri, $controller . 'index')->name('marca.index');
