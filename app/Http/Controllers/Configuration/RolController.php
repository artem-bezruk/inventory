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
