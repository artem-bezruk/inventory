<?php
namespace App\Providers;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;
class RouteServiceProvider extends ServiceProvider
{
	protected $namespace = 'App\Http\Controllers';
	public const HOME = '/dashboard';
	public function boot()
	{
		Route::pattern('user', '[0-9]+');
		Route::pattern('bien', '[0-9]+');
		Route::pattern('clase', '[0-9]+');
		Route::pattern('subclase', '[0-9]+');
		Route::pattern('categoria', '[0-9]+');
		Route::pattern('subcategoria', '[0-9]+');
		Route::pattern('marca', '[0-9]+');
		Route::pattern('capacidad', '[0-9]+');
		Route::pattern('estatu', '[0-9]+');
		Route::pattern('genero', '[0-9]+');
		Route::pattern('modulo', '[0-9]+');
		Route::pattern('nomenclatura', '[0-9]+');
		Route::pattern('rol', '[0-9]+');
		Route::pattern('modulorol', '[0-9]+');
		parent::boot();
	}
	public function map()
	{
		$this->mapApiRoutes();
		$this->mapWebRoutes();
	}
	protected function mapWebRoutes()
	{
		Route::middleware('web')
			->namespace($this->namespace)
			->group(base_path('routes/web.php'));
	}
	protected function mapApiRoutes()
	{
		Route::prefix('api')
			->middleware('api')
			->namespace($this->namespace)
			->group(base_path('routes/api.php'));
	}
}
