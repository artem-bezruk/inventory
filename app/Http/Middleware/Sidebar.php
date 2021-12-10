<?php
namespace App\Http\Middleware;
use Closure;
use App\Modulo;
use App\ModuloByRol;
class Sidebar
{
    public function handle($request, Closure $next)
    {
        if (auth()->user()) {
            $modulos = $this->gestionPermisos(auth()->user()->rol_id);
            session()->flash('modulos', $modulos);
        }
        return $next($request);
    }
    public function gestionPermisos ($rol)
    {
        $modulos = [
            'clases' => [],
            'sub_clases' => [],
            'categorias' => [],
            'sub_categorias' => [],
            'marcas' => [],
            'capacidades' => [],
            'estatus' => [],
            'generos' => [],
            'nomenclaturas' => [],
            'bitacora' => [],
            'modulos' => [],
            'roles' => [],
            'bienes' => [],
            'users' => [],
            'marcas_has_categorias' => [],
            'modulos_has_roles' => [],
            'configuraciones' => [],
        ];
        foreach ($modulos as $key => $modulo) {
            $modulo_id = Modulo::where('modulo', $key)->first()->id;
            $aux = ModuloByRol::where('rol_id', $rol)->where('modulo_id', $modulo_id)->get();
            foreach ($aux as $value) {
                $permisos = [
                    'c' => false,
                    'r' => false,
                    'u' => false,
                    'd' => false,
                ];
                if ($value->create) {
                    $permisos['c'] = true;
                }
                if ($value->read) {
                    $permisos['r'] = true;
                }
                if ($value->update) {
                    $permisos['u'] = true;
                }
                if ($value->delete) {
                    $permisos['d'] = true;
                }
                $modulo = $permisos;
                $modulos[$key] = (object) $modulo;
            }
        }
        return (object) $modulos;
    }
}
