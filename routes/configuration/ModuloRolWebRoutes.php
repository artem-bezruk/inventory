<?php
static $uri = 'configurations/modulesbyroles'; 
static $controller = 'Configuration\ModuloHasRolController@'; 
Route::get($uri, $controller . 'index')->name('modulorol.index')->middleware('checkRol:modulos_has_roles,r');
Route::get($uri . '/create', $controller . 'create')->name('modulorol.create')->middleware('checkRol:modulos_has_roles,c-r');
Route::post($uri, $controller . 'store')->name('modulorol.store')->middleware('checkRol:modulos_has_roles,c-r');
Route::get($uri . '/list', $controller . 'modulos_has_roles')->name('modulorol.list')->middleware('checkRol:modulos_has_roles,r');
Route::get($uri. '/{modulorol}/show', $controller . 'show')->name('modulorol.show')->middleware('checkRol:modulos_has_roles,r');
Route::get($uri . '/{modulorol}/edit', $controller . 'edit')->name('modulorol.edit')->middleware('checkRol:modulos_has_roles,r-u');
Route::put($uri . '/{modulorol}', $controller . 'update')->name('modulorol.update')->middleware('checkRol:modulos_has_roles,r-u');
Route::delete($uri . '/{modulorol}', $controller . 'destroy')->name('modulorol.destroy')->middleware('checkRol:modulos_has_roles,r-d');
