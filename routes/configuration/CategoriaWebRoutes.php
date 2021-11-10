<?php
static $uri = 'configurations/categories'; 
static $controller = 'Configuration\CategoriaController@'; 
Route::get($uri, $controller . 'index')->name('categoria.index');
