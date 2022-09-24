<?php
namespace App\Http\Controllers\Configuration;
use Validator;
use App\ModuloByRol;
use App\Enums\HttpStatus;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class ModuloHasRolController extends Controller
{
	protected $respuesta = [];
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index ()
    {
    	return view('modulorol.index');
	}
	public function modulos_has_roles (Request $request)
	{
		try {
            $all = ModuloByRol::all();
            $this->respuesta["data"] = [];
            foreach ($all as $modulorol) {
                $this->respuesta["data"][] = (object) [
                    'id' => $modulorol->id,
					'rol' => __($modulorol->rol()->rol),
					'modulo' => __($modulorol->modulo()->modulo),
                    'urlMostrar' => route("modulorol.show", ['locale' => app()->getLocale(), 'modulorol' => $modulorol->id]),
                    'urlEditar' => route("modulorol.edit", ['locale' => app()->getLocale(), 'modulorol' => $modulorol->id]),
                    'urlEliminar' => route("modulorol.destroy", ['locale' => app()->getLocale(), 'modulorol' => $modulorol->id])
                ];
            }
            if (empty($this->respuesta["data"])) {
                $httpStatus = HttpStatus::NOCONTENT;
            }
            else {
                $httpStatus = HttpStatus::OK;
            }
        } catch (\Exception $e) {
            $this->respuesta["mensaje"] = $e->getMessage() ?? HttpStatus::ERROR();
            $httpStatus = HttpStatus::ERROR;
        }
        return response()->json($this->respuesta, $httpStatus);
	}
    public function create()
    {
		$this->respuesta["extras"] = (object) [
			"modulos" => \App\Modulo::where('eliminado', 0)->get(),
			"roles" => \App\Rol::where('eliminado', 0)->get(),
		];
        return response()->view('modulorol.crear', $this->respuesta, HttpStatus::OK);
    }
    public function store(Request $request)
    {
        Validator::make($request->all(), [
			'modulo' => ['required', 'numeric'],
			'rol' => ['required', 'numeric'],
			'crear' => ['boolean'],
			'mostrar' => ['boolean', 'required_with:crear, editar, eliminar'],
			'editar' => ['boolean'],
			'eliminar' => ['boolean'],
		])->validate();
		$existe = ModuloByRol::where('modulo_id', $request->modulo)->where('rol_id', $request->rol)->get();
		if ($existe->isNotEmpty()) {
			$this->respuesta["mensaje"] = __('The relationship between Module and Rol already exists');
			return response()->json($this->respuesta, HttpStatus::BADREQUEST);
		}
		$modulorol = new ModuloByRol();
		$modulorol->modulo_id = $request->modulo;
		$modulorol->rol_id = $request->rol;
		$modulorol->create = $request->crear ?? 0;
		$modulorol->read = $request->mostrar ?? 0;
		$modulorol->update = $request->editar ?? 0;
		$modulorol->delete = $request->eliminar ?? 0;
		try {
            $modulorol->save();
            $bitacora = new \App\Bitacora();
            $modulo = \App\Modulo::where('modulo', 'modulos_has_roles')->first();
            $accion = \App\Accion::where('accion', 'Create')->first();
            $descripcion = "Created Module by Rol";
            $bitacora->registro($modulo->id, $modulorol->id, $accion->id, \Request::ip(), $descripcion);
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
