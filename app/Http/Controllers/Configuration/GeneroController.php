<?php
namespace App\Http\Controllers\Configuration;
use Validator;
use App\Genero;
use App\Enums\HttpStatus;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class GeneroController extends Controller
{
	protected $respuesta = [];
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index ()
    {
    	return view('genero.index');
    }
    public function generos (Request $request)
    {
        try {
            $all = Genero::where('eliminado', 0)->get();
            $this->respuesta["data"] = [];
            foreach ($all as $genero) {
                $this->respuesta["data"][] = (object) [
                    'id' => $genero->id,
                    'genero' => __($genero->genero),
                    'urlMostrar' => route("genero.show", ['locale' => app()->getLocale(), 'genero' => $genero->id]),
                    'urlEditar' => route("genero.edit", ['locale' => app()->getLocale(), 'genero' => $genero->id]),
                    'urlEliminar' => route("genero.destroy", ['locale' => app()->getLocale(), 'genero' => $genero->id])
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
        return response()->view('genero.crear', $this->respuesta, HttpStatus::OK);
    }
    public function store(Request $request)
    {
    	Validator::make($request->all(), [
            'genero' => ['required', 'regex:/^([a-zA-Z]+(.*))+$/'],
        ])->validate();
        $genero = new Genero();
        $genero->genero = $request->genero;
        try {
            $genero->save();
            $bitacora = new \App\Bitacora();
            $modulo = \App\Modulo::where('modulo', 'generos')->first();
            $accion = \App\Accion::where('accion', 'Create')->first();
            $descripcion = "Created Gender";
            $bitacora->registro($modulo->id, $genero->id, $accion->id, \Request::ip(), $descripcion);
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
            $genero = Genero::find($id);
            if (!empty($genero)) {
                $this->respuesta["data"] = (object) [
                    "genero" => __($genero->genero)
                ];
                return response()->view('genero.mostrar', $this->respuesta, HttpStatus::OK);
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
            $genero = Genero::find($id);
            if (!empty($genero)) {
                $this->respuesta["data"] = (object) [
                    'id' => $genero->id,
                    'genero' => $genero->genero,
                ];
                return response()->view('genero.editar', $this->respuesta, HttpStatus::OK);
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
            'genero' => ['required', 'regex:/^([a-zA-Z]+(.*))+$/'],
        ])->validate();
        $genero = Genero::find($id);
        $genero->genero = $request->genero;
        try {
            if ($genero->isDirty()) {
                $genero->save();
                $bitacora = new \App\Bitacora();
                $modulo = \App\Modulo::where('modulo', 'generos')->first();
                $accion = \App\Accion::where('accion', 'Update')->first();
                $descripcion = "Updated Gender";
                $bitacora->registro($modulo->id, $genero->id, $accion->id, \Request::ip(), $descripcion);
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
    public function destroy($id)
    {
    }
}
