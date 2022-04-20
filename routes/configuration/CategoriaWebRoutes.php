<?php
static $uri = 'configurations/categories'; 
static $controller = 'Configuration\CategoriaController@'; 
Route::get($uri, $controller . 'index')->name('categoria.index')->middleware('checkRol:categorias,r');
Route::get($uri . '/create', $controller . 'create')->name('categoria.create')->middleware('checkRol:categorias,c-r');
Route::post($uri, $controller . 'store')->name('categoria.store')->middleware('checkRol:categorias,c-r');
Route::get($uri . '/list', $controller . 'listaCategorias')->name('categoria.list')->middleware('checkRol:categorias,r');
Route::get($uri. '/{categoria}/show', $controller . 'show')->name('categoria.show')->middleware('checkRol:categorias,r');
Route::get($uri . '/{categoria}/edit', $controller . 'edit')->name('categoria.edit')->middleware('checkRol:categorias,r-u');
Route::put($uri . '/{categoria}', $controller . 'update')->name('categoria.update')->middleware('checkRol:categorias,r-u');
Route::delete($uri . '/{categoria}', $controller . 'destroy')->name('categoria.destroy')->middleware('checkRol:categorias,r-d');
Route::get('categories/{subclase}', $controller . 'categorias')->where(['subclase' => '[0-9]+'])->name('categorias')->middleware('checkRol:bienes,c');
