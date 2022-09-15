<?php
namespace App\Http\Controllers\Configuration;
use Validator;
use App\Rol;
use App\Enums\HttpStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class RolController extends Controller
{
	protected $respuesta = [];
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index ()
    {
    	return view('rol.index');
	}
	public function roles (Request $request)
	{
		try {
            $all = Rol::where('eliminado', 0)->get();
            $this->respuesta["data"] = [];
            foreach ($all as $rol) {
                $this->respuesta["data"][] = (object) [
                    'id' => $rol->id,
					'rol' => __($rol->rol),
					'descripcion' => __($rol->descripcion),
					'prioridad' => $rol->prioridad,
                    'urlMostrar' => route("rol.show", ['locale' => app()->getLocale(), 'rol' => $rol->id]),
                    'urlEditar' => route("rol.edit", ['locale' => app()->getLocale(), 'rol' => $rol->id]),
                    'urlEliminar' => route("rol.destroy", ['locale' => app()->getLocale(), 'rol' => $rol->id])
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
        return response()->view('rol.crear', $this->respuesta, HttpStatus::OK);
    }
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'rol' => ['required', 'regex:/^([a-zA-Z]+(.*))+$/'],
			'prioridad' => ['required', 'numeric', 'min:0', 'max:99', 'unique:roles,prioridad'],
			'descripcion' => ['nullable', 'regex:/^([a-zA-Z-Z\u00D1\u00F1\u00C1\u00E1\u00C9\u00E9\u00CD\u00ED\u00D3\u00F3\u00DA\u00FAs\s]|[0-9]|-|_|&|%|.|,)*$/'],
		])->validate();
		$rol = new Rol();
		$rol->rol = $request->rol;
		$rol->prioridad = $request->prioridad;
		$rol->descripcion = $request->descripcion;
		try {
            $rol->save();
            $bitacora = new \App\Bitacora();
            $modulo = \App\Modulo::where('modulo', 'modulos')->first();
            $accion = \App\Accion::where('accion', 'Create')->first();
            $descripcion = "Created Module";
            $bitacora->registro($modulo->id, $rol->id, $accion->id, \Request::ip(), $descripcion);
            $httpStatus = HttpStatus::CREATED;
            $this->respuesta["mensaje"] = HttpStatus::CREATED();
    	} catch (\Exception $e) {
            $this->respuesta["mensaje"] = HttpStatus::ERROR();
            $httpStatus = HttpStatus::ERROR;
    	}
        return response()->json($this->respuesta, $httpStatus);
    }
    public function show($local, $id)
    {
        try {
            $rol = Rol::find($id);
            if (!empty($rol)) {
                $this->respuesta["data"] = (object) [
					"rol" => __($rol->rol),
					"prioridad" => $rol->prioridad,
					"descripcion" => __($rol->descripcion),
                ];
                return response()->view('rol.mostrar', $this->respuesta, HttpStatus::OK);
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
    public function edit($local, $id)
    {
        try {
            $rol = Rol::find($id);
            if (!empty($rol)) {
                $this->respuesta["data"] = (object) [
                    'id' => $rol->id,
					'rol' => $rol->rol,
					'prioridad' => $rol->prioridad,
					'descripcion' => $rol->descripcion,
                ];
                return response()->view('rol.editar', $this->respuesta, HttpStatus::OK);
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
    public function update(Request $request, $local, $id)
    {
        Validator::make($request->all(), [
            'rol' => ['required', 'regex:/^([a-zA-Z]+(.*))+$/'],
			'prioridad' => ['required', 'numeric', 'min:0', 'max:99'],
			'descripcion' => ['nullable', 'regex:/^([a-zA-Z-Z\u00D1\u00F1\u00C1\u00E1\u00C9\u00E9\u00CD\u00ED\u00D3\u00F3\u00DA\u00FAs\s]|[0-9]|-|_|&|%|.|,)*$/'],
		])->validate();
		$rol = Rol::find($id);
		$rol->rol = $request->rol;
		$rol->prioridad = $request->prioridad;
		$rol->descripcion = $request->descripcion;
		try {
            if ($rol->isDirty()) {
                $rol->save();
                $bitacora = new \App\Bitacora();
                $modulo = \App\Modulo::where('modulo', 'modulos')->first();
                $accion = \App\Accion::where('accion', 'Update')->first();
                $descripcion = "Updated Module";
                $bitacora->registro($modulo->id, $rol->id, $accion->id, \Request::ip(), $descripcion);
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
