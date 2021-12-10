<?php
namespace App\Http\Middleware;
use Closure;
use App\ModuloByRol;
use App\Modulo;
class CheckRole
{
    public function handle($request, Closure $next, $modulo, $prioridades)
    {
        $rol_id = auth()->user()->rol_id;
        $modulo_id = Modulo::where('modulo', $modulo)->first()->id;
        $prioridades = explode('-', $prioridades);
        $permisos = ModuloByRol::where('modulo_id', $modulo_id)
            ->where('rol_id', $rol_id)
            ->first();
        $mensaje = (object) [
            "tipo" => 'e',
            "mensaje" => __('You don\'t have the permissions necessary to access')
        ];
        foreach ($prioridades as $prioridad) {
            if ($prioridad == "c" && $permisos->create == false) {
                session()->flash('alerta', $mensaje);
                return redirect()->route('dashboard', ['locale' => app()->getLocale()]);
            }
            if ($prioridad == "r" && $permisos->read == false) {
                session()->flash('alerta', $mensaje);
                return redirect()->route('dashboard', ['locale' => app()->getLocale()]);
            }
            if ($prioridad == "u" && $permisos->update == false) {
                session()->flash('alerta', $mensaje);
                return redirect()->route('dashboard', ['locale' => app()->getLocale()]);
            }
            if ($prioridad == "d" && $permisos->delete == false) {
                session()->flash('alerta', $mensaje);
                return redirect()->route('dashboard', ['locale' => app()->getLocale()]);
            }
        }
        return $next($request);
    }
}
