<?php
static $uri = 'configurations/capacities'; 
static $controller = 'Configuration\CapacidadController@'; 
Route::get($uri, $controller . 'index')->name('capacidad.index');
