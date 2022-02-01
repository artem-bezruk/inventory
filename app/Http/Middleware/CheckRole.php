<?php
namespace App\Http\Middleware;
use Closure;
use App\ModuloByRol;
use App\Modulo;
use App\Enums\HttpStatus;
class CheckRole
{
    public function handle($request, Closure $next, $modulo, $prioridades)
    {
        if (auth()->user()->eliminado) {
            auth()->guard()->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect(route('home', ['locale' => app()->getLocale()]));
        }
        $rol_id = auth()->user()->rol_id;
        $modulo_id = Modulo::where('modulo', $modulo)->first()->id;
        $prioridades = explode('-', $prioridades);
        $permisos = ModuloByRol::where('modulo_id', $modulo_id)
            ->where('rol_id', $rol_id)
            ->first();
        $cumple = true;
        $mensaje = (object) [
            "tipo" => 'e',
            "mensaje" => __('You don\'t have the permissions necessary to access')
        ];
        foreach ($prioridades as $prioridad) {
            if ($prioridad == "c" && $permisos->create == false) {
                $cumple = false;
            }
            if ($prioridad == "r" && $permisos->read == false) {
                $cumple = false;
            }
            if ($prioridad == "u" && $permisos->update == false) {
                $cumple = false;
            }
            if ($prioridad == "d" && $permisos->delete == false) {
                $cumple = false;
            }
        }
        if (!$cumple) {
            if ($request->expectsJson()) {
                return response()->json($mensaje, HttpStatus::FORBIDDEN);
            }
            else {
                session()->flash('alerta', $mensaje);
                return redirect()->route('dashboard', ['locale' => app()->getLocale()]);
            }
        }
        return $next($request);
    }
}
