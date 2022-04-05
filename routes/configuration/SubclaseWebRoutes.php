<?php
static $uri = 'configurations/subclasses'; 
static $controller = 'Configuration\SubclaseController@'; 
Route::get($uri, $controller . 'index')->name('subclase.index')->middleware('checkRol:sub_clases,r');
Route::get($uri . '/create', $controller . 'create')->name('subclase.create')->middleware('checkRol:sub_clases,c-r');
Route::post($uri, $controller . 'store')->name('subclase.store')->middleware('checkRol:sub_clases,c-r');
Route::get($uri . '/list', $controller . 'listaSubclases')->name('subclase.list')->middleware('checkRol:sub_clases,r');
Route::get($uri. '/{subclase}/show', $controller . 'show')->name('subclase.show')->middleware('checkRol:sub_clases,r');
Route::get($uri . '/{subclase}/edit', $controller . 'edit')->name('subclase.edit')->middleware('checkRol:sub_clases,r-u');
Route::put($uri . '/{subclase}', $controller . 'update')->name('subclase.update')->middleware('checkRol:sub_clases,r-u');
Route::delete($uri . '/{subclase}', $controller . 'destroy')->name('subclase.destroy')->middleware('checkRol:sub_clases,r-d');
Route::get('subclasses/{clase}', $controller . 'subclases')->where(['clase' => '[0-9]+'])->name('subclases')->middleware('checkRol:bienes,c');
