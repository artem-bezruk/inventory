<?php
namespace App\Http\Controllers\Configuration;
use Validator;
use App\Clase;
use App\Enums\HttpStatus;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class ClaseController extends Controller
{
    protected $respuesta = [];
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index ()
    {
        return view('clase.index');
    }
    public function clases(Request $request)
    {
        try {
            $all = Clase::where('eliminado', 0)->get();
            $this->respuesta["data"] = [];
            foreach ($all as $clase) {
                $this->respuesta["data"][] = (object) [
                    'id' => $clase->id,
                    'clase' => __($clase->clase),
                    'urlMostrar' => route("clase.show", ['locale' => app()->getLocale(), 'clase' => $clase->id]),
                    'urlEditar' => route("clase.edit", ['locale' => app()->getLocale(), 'clase' => $clase->id]),
                    'urlEliminar' => route("clase.destroy", ['locale' => app()->getLocale(), 'clase' => $clase->id])
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
        return response()->view('clase.crear', $this->respuesta, HttpStatus::OK);
    }
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'clase' => ['required', 'regex:/^([a-zA-Z]+(.*))+$/'],
        ])->validate();
        $clase = new Clase();
        $clase->clase = $request->clase;
        try {
            $clase->save();
            $bitacora = new \App\Bitacora();
            $modulo = \App\Modulo::where('modulo', 'clases')->first();
            $accion = \App\Accion::where('accion', 'Create')->first();
            $descripcion = "Created Class";
            $bitacora->registro($modulo->id, $clase->id, $accion->id, \Request::ip(), $descripcion);
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
            $clase = Clase::find($id);
            if (!empty($clase)) {
                $this->respuesta["data"] = (object) [
                    "clase" => __($clase->clase)
                ];
                return response()->view('clase.mostrar', $this->respuesta, HttpStatus::OK);
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
            $clase = Clase::find($id);
            if (!empty($clase)) {
                $this->respuesta["data"] = (object) [
                    'id' => $clase->id,
                    'clase' => $clase->clase,
                ];
                return response()->view('clase.editar', $this->respuesta, HttpStatus::OK);
            }
            else {
                $httpStatus = HttpStatus::NOCONTENT;
            }
        } catch (\Exception $e) {
            $this->respuesta["message"] = $e->getMessage() ?? HttpStatus::ERROR();
            $httpStatus = HttpStatus::ERROR;
        }
        return response()->json($this->respuesta, $httpStatus);
    }
    public function update(Request $request, $locale, $id)
    {
        Validator::make($request->all(), [
            'clase' => ['required', 'regex:/^([a-zA-Z]+(.*))+$/'],
        ])->validate();
        $clase = Clase::find($id);
        $clase->clase = $request->clase;
        try {
            if ($clase->isDirty()) {
                $clase->save();
                $bitacora = new \App\Bitacora();
                $modulo = \App\Modulo::where('modulo', 'clases')->first();
                $accion = \App\Accion::where('accion', 'Update')->first();
                $descripcion = "Updated Class";
                $bitacora->registro($modulo->id, $clase->id, $accion->id, \Request::ip(), $descripcion);
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
        $clase = Clase::find($id);
        try {
            $clase->eliminado = 1;
            $clase->save();
            $bitacora = new \App\Bitacora();
            $modulo = \App\Modulo::where('modulo', 'clases')->first();
            $accion = \App\Accion::where('accion', 'Delete')->first();
            $descripcion = "Deleted Class";
            $bitacora->registro($modulo->id, $clase->id, $accion->id, \Request::ip(), $descripcion);
            $httpStatus = HttpStatus::OK;
            $this->respuesta["mensaje"] = HttpStatus::OK();
        } catch (\Exception $e) {
            $httpStatus = HttpStatus::ERROR;
            $this->respuesta["mensaje"] = $e->getMessage();
        }
        return response()->json($this->respuesta, $httpStatus);
    }
}
