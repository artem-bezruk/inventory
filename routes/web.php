<?php
use Illuminate\Support\Facades\Route;
Route::get('/', function () {
	return redirect(app()->getLocale() . '/home');
});
Route::group([ 'prefix' => '{locale}', 'where' => ['locale' => '[a-z]{2}'], 'middleware' => 'language' ], function () {
	Route::get('/home', function () {
		return view('layouts.home');
	})->name('home');
	Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
	Route::post('login', 'Auth\LoginController@login');
	Route::post('logout', 'Auth\LoginController@logout')->name('logout');
	require "dashboard/DashboardWebRoutes.php";
	require "configuration/ConfigurationWebRoutes.php";
	require "user/UserWebRoutes.php";
	require "bitacora/BitacoraWebRoutes.php";
	require "configuration/ClaseWebRoutes.php";
	require "configuration/SubclaseWebRoutes.php";
	require "configuration/CategoriaWebRoutes.php";
	require "configuration/SubcategoriaWebRoutes.php";
	require "configuration/MarcaWebRoutes.php";
	require "configuration/CapacidadWebRoutes.php";
	require "configuration/EstatuWebRoutes.php";
	require "configuration/GeneroWebRoutes.php";
	require "configuration/ModuloWebRoutes.php";
	require "configuration/NomenclaturaWebRoutes.php";
	require "configuration/RolWebRoutes.php";
	require "configuration/MarcaSubcategoriaWebRoutes.php";
	require "configuration/ModuloRolWebRoutes.php";
	require "bien/BienWebRoutes.php";
});
