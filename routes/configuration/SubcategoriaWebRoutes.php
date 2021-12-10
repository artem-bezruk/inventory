<?php
static $uri = 'configurations/subcategories'; 
static $controller = 'Configuration\SubcategoriaController@'; 
Route::get($uri, $controller . 'index')->name('subcategoria.index')->middleware('checkRol:sub_categorias,r');
