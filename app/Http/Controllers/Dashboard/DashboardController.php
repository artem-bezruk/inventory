<?php
namespace App\Http\Controllers\Dashboard;
use App\Dashboard;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class DashboardController extends Controller
{
    protected $respuesta = [];
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index ()
    {
        $dashboard = new Dashboard();
        try {
            $usuarios = $dashboard->usuarios();
            $bienes = $dashboard->bienes();
            $actividades = $dashboard->actividades();
            $this->respuesta["data"] = (object) [
                "usuarios" => $usuarios,
                "bienes" => $bienes,
                "actividades" => $actividades
            ];
        } catch (\Exception $e) {
            $mensaje = (object) [
                "tipo" => 'e',
                "mensaje" => __('Oops! Something went wrong')
            ];
            session()->flash('alerta', $mensaje);
        }
    	return view('dashboard.index', $this->respuesta);
    }
}
