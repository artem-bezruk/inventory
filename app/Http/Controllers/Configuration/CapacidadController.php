<?php
namespace App\Http\Controllers\Configuration;
use Validator;
use App\Capacidad;
use App\Enums\HttpStatus;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class CapacidadController extends Controller
{
	protected $respuesta = [];
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index ()
    {
    	return view('capacidad.index');
    }
    public function capacidades (Request $request)
    {
    	try {
            $all = Capacidad::where('eliminado', 0)->get();
            $this->respuesta["data"] = [];
            foreach ($all as $capacidad) {
                $this->respuesta["data"][] = (object) [
                    'id' => $capacidad->id,
                    'capacidad' => $capacidad->capacidad . " " . __($capacidad->nomenclatura()->nomenclatura) . " (" . $capacidad->nomenclatura()->abreviatura . ")",
                    'urlMostrar' => route("capacidad.show", ['locale' => app()->getLocale(), 'capacidad' => $capacidad->id]),
                    'urlEditar' => route("capacidad.edit", ['locale' => app()->getLocale(), 'capacidad' => $capacidad->id]),
                    'urlEliminar' => route("capacidad.destroy", ['locale' => app()->getLocale(), 'capacidad' => $capacidad->id])
                ];
            }
            if (empty($this->respuesta["data"])) {
                $httpStatus = HttpStatus::NOCONTENT;
            }
            else {
                $httpStatus = HttpStatus::OK;
            }
        } catch (\Exception $e) {
            $this->respuesta["mensaje"] = HttpStatus::ERROR();
            $httpStatus = HttpStatus::ERROR;
        }
        return response()->json($this->respuesta, $httpStatus);
    }
    public function create()
    {
    	$this->respuesta["extras"] = (object) [
			"nomenclaturas" => \App\Nomenclatura::where("eliminado", 0)->get(),
		];
        return response()->view('capacidad.crear', $this->respuesta, HttpStatus::OK);
    }
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'capacidad' => ['required', 'integer'],
            'nomenclatura' => ['required', 'numeric'],
        ])->validate();
        $capacidad = new Capacidad();
        $capacidad->capacidad = $request->capacidad;
        $capacidad->nomenclatura_id = $request->nomenclatura;
        try {
            $capacidad->save();
            $bitacora = new \App\Bitacora();
            $modulo = \App\Modulo::where('modulo', 'capacidades')->first();
            $accion = \App\Accion::where('accion', 'Create')->first();
            $descripcion = "Created Capacity";
            $bitacora->registro($modulo->id, $capacidad->id, $accion->id, \Request::ip(), $descripcion);
            $httpStatus = HttpStatus::CREATED;
            $this->respuesta["mensaje"] = HttpStatus::CREATED();
        } catch (\Exception $e) {
            $this->respuesta["mensaje"] = HttpStatus::ERROR();
            $httpStatus = HttpStatus::ERROR;
        }
        return response()->json($this->respuesta, $httpStatus);
    }
    public function show($id)
    {
    }
    public function edit($id)
    {
    }
    public function update(Request $request, $id)
    {
    }
    public function destroy($id)
    {
    }
}
