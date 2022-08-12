<?php
namespace App\Http\Controllers\Configuration;
use Validator;
use App\Modulo;
use App\Enums\HttpStatus;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class ModuloController extends Controller
{
    protected $respuesta = [];
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index ()
    {
    	return view('modulo.index');
    }
    public function modulos (Request $request)
    {
    	try {
            $all = Modulo::where('eliminado', 0)->get();
            $this->respuesta["data"] = [];
            foreach ($all as $modulo) {
                $this->respuesta["data"][] = (object) [
                    'id' => $modulo->id,
                    'modulo' => __($modulo->modulo),
                    'filtrable' => $modulo->filtrable ? __("Yes") : __("No"),
                    'urlMostrar' => route("modulo.show", ['locale' => app()->getLocale(), 'modulo' => $modulo->id]),
                    'urlEditar' => route("modulo.edit", ['locale' => app()->getLocale(), 'modulo' => $modulo->id]),
                    'urlEliminar' => route("modulo.destroy", ['locale' => app()->getLocale(), 'modulo' => $modulo->id])
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
    	return response()->view('modulo.crear', $this->respuesta, HttpStatus::OK);
    }
    public function store(Request $request)
    {
    	Validator::make($request->all(), [
            'modulo' => ['required', 'regex:/^([a-zA-Z]+(.*))+$/'],
            'filtrable' => ['boolean'],
        ])->validate();
        $newModulo = new Modulo();
        $newModulo->modulo = $request->modulo;
        $newModulo->filtrable = $request->filtrable ?? false;
    	try {
            $newModulo->save();
            $bitacora = new \App\Bitacora();
            $modulo = \App\Modulo::where('modulo', 'modulos')->first();
            $accion = \App\Accion::where('accion', 'Create')->first();
            $descripcion = "Created Module";
            $bitacora->registro($modulo->id, $newModulo->id, $accion->id, \Request::ip(), $descripcion);
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
            $modulo = Modulo::find($id);
            if (!empty($modulo)) {
                $this->respuesta["data"] = (object) [
					"modulo" => __($modulo->modulo),
					"filtrable" => $modulo->filtrable ? __("Yes") : __('No'),
                ];
                return response()->view('modulo.mostrar', $this->respuesta, HttpStatus::OK);
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
            $modulo = Modulo::find($id);
            if (!empty($modulo)) {
                $this->respuesta["data"] = (object) [
                    'id' => $modulo->id,
					'modulo' => $modulo->modulo,
					'filtrable' => $modulo->filtrable,
                ];
                return response()->view('modulo.editar', $this->respuesta, HttpStatus::OK);
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
            'modulo' => ['required', 'regex:/^([a-zA-Z]+(.*))+$/'],
            'filtrable' => ['boolean'],
		])->validate();
		$editModulo = Modulo::find($id);
        $editModulo->modulo = $request->modulo;
		$editModulo->filtrable = $request->filtrable ?? false;
		try {
            if ($editModulo->isDirty()) {
                $editModulo->save();
                $bitacora = new \App\Bitacora();
                $modulo = \App\Modulo::where('modulo', 'modulos')->first();
                $accion = \App\Accion::where('accion', 'Update')->first();
                $descripcion = "Updated Module";
                $bitacora->registro($modulo->id, $editModulo->id, $accion->id, \Request::ip(), $descripcion);
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
