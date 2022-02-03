<?php
namespace App\Http\Controllers\Bitacora;
use App\Bitacora;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Enums\HttpStatus;
class BitacoraController extends Controller
{
    protected $respuesta = [];
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index ()
    {
        $this->respuesta["extras"] = (object) [
            "users" => \App\User::all(),
            "modulos" => \App\Modulo::where('filtrable', 1)->get(),
            "acciones" => \App\Accion::all(),
        ];
        return view('bitacora.index', $this->respuesta);
    }
    public function lista(Request $request)
    {
        $username = $request->username;
        $modulo = $request->modulo;
        $data = [];
        $fecha = [];
        if ($request->username) {
            $data["user_id"] = $request->username;
        }
        if ($request->modulo) {
            $data["modulo_id"] = $request->modulo;
        }
        if ($request->accion) {
            $data["accion_id"] = $request->accion;
        }
        if ($request->fecha_inicio && $request->fecha_fin) {
            $fecha_inicio = new \DateTime($request->fecha_inicio);
            $fecha[0] = $fecha_inicio->format('Y-m-d');
            $fecha_fin = new \DateTime($request->fecha_fin);
            $fecha[1] =  $fecha_fin->format('Y-m-d');
        }
        $query = Bitacora::where($data);
        if (!empty($fecha)) {
            $query->whereBetween('fecha',  $fecha);
        }
        try {
            $all = $query->get();
            $this->respuesta["data"] = [];
            foreach ($all as $value) {
                $fecha = new \DateTime($value->fecha . " ". $value->hora);
                $this->respuesta["data"][] = (object) [
                    'usuario' => $value->user()->username,
                    'modulo' => $value->modulo()->modulo ?? __('Doesn\'t apply'),
                    'item' => $value->item ?? __('Doesn\'t apply'),
                    'accion' => __($value->accion()->accion),
                    'ip' => $value->ip,
                    'descripcion' => __($value->descripcion),
                    'fecha' => $fecha->format('d-m-Y H:i:s'),
                ];
            }
            if (empty($this->respuesta["data"])) {
                $httpStatus = HttpStatus::NOCONTENT;
            }
            else {
                $httpStatus = HttpStatus::OK;
                $this->respuesta["mensaje"] = HttpStatus::OK();
            }
        } catch (\Exception $e) {
            $httpStatus = HttpStatus::ERROR;
            $this->respuesta["mensaje"] = HttpStatus::ERROR();
            $this->respuesta["mensajee"] = $e->getMessage();
        }
        return response()->json($this->respuesta, $httpStatus);
    }
}
