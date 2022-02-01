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
        return view('bitacora.index');
    }
    public function lista(Request $request)
    {
        try {
            $all = Bitacora::all();
            $this->respuesta["data"] = [];
            foreach ($all as $value) {
                $fecha = new \DateTime($value->fecha);
                $this->respuesta["data"][] = (object) [
                    'usuario' => $value->user()->username,
                    'modulo' => $value->modulo()->modulo ?? __('Doesn\'t apply'),
                    'item' => $value->item ?? __('Doesn\'t apply'),
                    'accion' => $value->accion()->accion,
                    'ip' => $value->ip,
                    'descripcion' => $value->descripcion,
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
        }
        return response()->json($this->respuesta, $httpStatus);
    }
}
