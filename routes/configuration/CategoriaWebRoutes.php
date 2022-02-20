<?php
static $uri = 'configurations/categories'; 
static $controller = 'Configuration\CategoriaController@'; 
Route::get($uri, $controller . 'index')->name('categoria.index')->middleware('checkRol:categorias,r');
Route::get('categories/{subclase}', $controller . 'categorias')->where(['subclase' => '[0-9]+'])->name('categorias')->middleware('checkRol:bienes,c');
