<?php
static $uri = 'configurations/subcategories'; 
static $controller = 'Configuration\SubcategoriaController@'; 
Route::get($uri, $controller . 'index')->name('subcategoria.index')->middleware('checkRol:sub_categorias,r');
Route::get('subcategories/{categoria}', $controller . 'subcategorias')->where(['categoria' => '[0-9]+'])->name('subcategorias')->middleware('checkRol:bienes,c');
