<?php
static $uri = 'configurations/estatus'; 
static $controller = 'Configuration\EstatuController@'; 
Route::get($uri, $controller . 'index')->name('estatu.index');
