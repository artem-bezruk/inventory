<?php
static $uri = 'configurations/subcategories'; 
static $controller = 'Configuration\SubcategoriaController@'; 
Route::get($uri, $controller . 'index')->name('subcategoria.index')->middleware('checkRol:sub_categorias,r');
Route::get($uri . '/create', $controller . 'create')->name('subcategoria.create')->middleware('checkRol:sub_categorias,c-r');
Route::post($uri, $controller . 'store')->name('subcategoria.store')->middleware('checkRol:sub_categorias,c-r');
Route::get($uri . '/list', $controller . 'listaSubcategorias')->name('subcategoria.list')->middleware('checkRol:sub_categorias,r');
Route::get($uri. '/{subcategoria}/show', $controller . 'show')->name('subcategoria.show')->middleware('checkRol:sub_categorias,r');
Route::get($uri . '/{subcategoria}/edit', $controller . 'edit')->name('subcategoria.edit')->middleware('checkRol:sub_categorias,r-u');
Route::put($uri . '/{subcategoria}', $controller . 'update')->name('subcategoria.update')->middleware('checkRol:sub_categorias,r-u');
Route::delete($uri . '/{subcategoria}', $controller . 'destroy')->name('subcategoria.destroy')->middleware('checkRol:sub_categorias,r-d');
Route::get('subcategories/{categoria}', $controller . 'subcategorias')->where(['categoria' => '[0-9]+'])->name('subcategorias')->middleware('checkRol:bienes,c');
