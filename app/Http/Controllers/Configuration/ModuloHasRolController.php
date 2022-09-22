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
    }
    public function store(Request $request)
    {
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
