<?php
namespace App\Http\Controllers\Configuration;
use Validator;
use App\Marca;
use App\Enums\HttpStatus;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class MarcaController extends Controller
{
	protected $respuesta = [];
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index ()
    {
    	return view('marca.index');
    }
    public function marcas (Request $request)
    {
    	try {
            $all = Marca::where('eliminado', 0)->get();
            $this->respuesta["data"] = [];
            foreach ($all as $marca) {
                $this->respuesta["data"][] = (object) [
                    'id' => $marca->id,
                    'marca' => __($marca->marca),
                    'urlMostrar' => route("marca.show", ['locale' => app()->getLocale(), 'marca' => $marca->id]),
                    'urlEditar' => route("marca.edit", ['locale' => app()->getLocale(), 'marca' => $marca->id]),
                    'urlEliminar' => route("marca.destroy", ['locale' => app()->getLocale(), 'marca' => $marca->id])
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
        return response()->view('marca.crear', $this->respuesta, HttpStatus::OK);
    }
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'marca' => ['required', 'regex:/^([a-zA-Z]+(.*))+$/'],
        ])->validate();
        $marca = new Marca();
        $marca->marca = $request->marca;
        try {
            $marca->save();
            $bitacora = new \App\Bitacora();
            $modulo = \App\Modulo::where('modulo', 'marcas')->first();
            $accion = \App\Accion::where('accion', 'Create')->first();
            $descripcion = "Created Mark";
            $bitacora->registro($modulo->id, $marca->id, $accion->id, \Request::ip(), $descripcion);
            $httpStatus = HttpStatus::CREATED;
            $this->respuesta["mensaje"] = HttpStatus::CREATED();
        } catch (\Exception $e) {
            $this->respuesta["mensaje"] = HttpStatus::ERROR();
            $httpStatus = HttpStatus::ERROR;
        }
        return response()->json($this->respuesta, $httpStatus);
    }
    public function show($locale, $id)
    {
        try {
            $marca = Marca::find($id);
            if (!empty($marca)) {
                $this->respuesta["data"] = (object) [
                    "marca" => __($marca->marca)
                ];
                return response()->view('marca.mostrar', $this->respuesta, HttpStatus::OK);
            }
            else {
                $httpStatus = HttpStatus::NOCONTENT;
            }
        } catch (\Exception $e) {
            $this->respuesta["mensaje"] = HttpStatus::ERROR();
            $httpStatus = HttpStatus::ERROR;
        }
        return response()->json($this->respuesta, $httpStatus);
    }
    public function edit($locale, $id)
    {
        try {
            $marca = Marca::find($id);
            if (!empty($marca)) {
                $this->respuesta["data"] = (object) [
                    'id' => $marca->id,
                    'marca' => $marca->marca,
                ];
                return response()->view('marca.editar', $this->respuesta, HttpStatus::OK);
            }
            else {
                $httpStatus = HttpStatus::NOCONTENT;
            }
        } catch (\Exception $e) {
            $this->respuesta["message"] = HttpStatus::ERROR();
            $httpStatus = HttpStatus::ERROR;
        }
        return response()->json($this->respuesta, $httpStatus);
    }
    public function update(Request $request, $locale, $id)
    {
        Validator::make($request->all(), [
            'marca' => ['required', 'regex:/^([a-zA-Z]+(.*))+$/'],
        ])->validate();
        $marca = Marca::find($id);
        $marca->marca = $request->marca;
        try {
        	if ($marca->isDirty()) {
            	$marca->save();
                $bitacora = new \App\Bitacora();
                $modulo = \App\Modulo::where('modulo', 'marcas')->first();
                $accion = \App\Accion::where('accion', 'Update')->first();
                $descripcion = "Updated Mark";
            	$bitacora->registro($modulo->id, $marca->id, $accion->id, \Request::ip(), $descripcion);
                $httpStatus = HttpStatus::OK;
                $this->respuesta["mensaje"] = HttpStatus::OK();
            }
            else {
                $httpStatus = HttpStatus::NOCONTENT;
            }
        } catch (\Exception $e) {
            $this->respuesta["mensaje"] = HttpStatus::ERROR();
            $httpStatus = HttpStatus::ERROR;
        }
        return response()->json($this->respuesta, $httpStatus);
    }
    public function destroy($locale, $id)
    {
        $marca = Marca::find($id);
        try {
            $marca->eliminado = 1;
            $marca->save();
            $bitacora = new \App\Bitacora();
            $modulo = \App\Modulo::where('modulo', 'marcas')->first();
            $accion = \App\Accion::where('accion', 'Delete')->first();
            $descripcion = "Deleted Mark";
            $bitacora->registro($modulo->id, $marca->id, $accion->id, \Request::ip(), $descripcion);
            $httpStatus = HttpStatus::OK;
            $this->respuesta["mensaje"] = HttpStatus::OK();
        } catch (\Exception $e) {
            $httpStatus = HttpStatus::ERROR;
            $this->respuesta["mensaje"] = HttpStatus::ERROR();
        }
        return response()->json($this->respuesta, $httpStatus);
    }
}
