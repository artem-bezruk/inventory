<?php
static $uri = 'configurations/marksbysubcategories'; 
static $controller = 'Configuration\MarcaHasSubcategoriaController@'; 
Route::get($uri, $controller . 'index')->name('marcasubcategoria.index')->middleware('checkRol:marcas_has_categorias,r');
