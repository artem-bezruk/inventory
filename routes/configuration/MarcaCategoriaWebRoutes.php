<?php
static $uri = 'configurations/marksbycategories'; 
static $controller = 'Configuration\MarcaHasCategoriaController@'; 
Route::get($uri, $controller . 'index')->name('marcacategoria.index')->middleware('checkRol:marcas_has_categorias,r');
Route::get('marksbycategories/{categoria}', $controller . 'marcascategorias')->where(['categoria' => '[0-9]+'])->name('marcacategoria')->middleware('checkRol:bienes,c');
