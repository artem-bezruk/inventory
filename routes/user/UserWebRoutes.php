<?php
static $uri = 'users'; 
static $controller = 'User\UserController@'; 
Route::get($uri, $controller . 'index')->name('user.index');
