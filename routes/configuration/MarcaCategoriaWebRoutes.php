<?php
static $uri = 'configurations/marksbycategories'; 
static $controller = 'Configuration\MarcaHasCategoriaController@'; 
Route::get($uri, $controller . 'index')->name('marcacategoria.index')->middleware('checkRol:marcas_has_categorias,r');
Route::get($uri . '/create', $controller . 'create')->name('marcacategoria.create')->middleware('checkRol:marcas_has_categorias,c-r');
Route::post($uri, $controller . 'store')->name('marcacategoria.store')->middleware('checkRol:marcas_has_categorias,c-r');
Route::get($uri . '/list', $controller . 'marcas_has_categorias')->name('marcacategoria.list')->middleware('checkRol:marcas_has_categorias,r');
Route::get($uri. '/{marcacategoria}/show', $controller . 'show')->name('marcacategoria.show')->middleware('checkRol:marcas_has_categorias,r');
Route::get($uri . '/{marcacategoria}/edit', $controller . 'edit')->name('marcacategoria.edit')->middleware('checkRol:marcas_has_categorias,r-u');
Route::put($uri . '/{marcacategoria}', $controller . 'update')->name('marcacategoria.update')->middleware('checkRol:marcas_has_categorias,r-u');
Route::delete($uri . '/{marcacategoria}', $controller . 'destroy')->name('marcacategoria.destroy')->middleware('checkRol:marcas_has_categorias,r-d');
Route::get('marksbycategories/{categoria}', $controller . 'marcascategorias')->where(['categoria' => '[0-9]+'])->name('marcacategoria')->middleware('checkRol:bienes,c');
