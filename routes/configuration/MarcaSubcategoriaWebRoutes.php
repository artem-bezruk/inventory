<?php
static $uri = 'configurations/marksbysubcategories'; 
static $controller = 'Configuration\MarcaHasSubcategoriaController@'; 
Route::get($uri, $controller . 'index')->name('marcasubcategoria.index');
