<?php
namespace App\Http\Controllers\Configuration;
use Validator;
use App\Nomenclatura;
use App\Enums\HttpStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class NomenclaturaController extends Controller
{
	protected $respuesta = [];
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index ()
    {
    	return view('nomenclatura.index');
	}
	public function nomenclaturas (Request $request)
	{
		try {
            $all = Nomenclatura::where('eliminado', 0)->get();
            $this->respuesta["data"] = [];
            foreach ($all as $nomenclatura) {
                $this->respuesta["data"][] = (object) [
                    'id' => $nomenclatura->id,
					'nomenclatura' => __($nomenclatura->nomenclatura),
					'abreviatura' => $nomenclatura->abreviatura,
                    'urlMostrar' => route("nomenclatura.show", ['locale' => app()->getLocale(), 'nomenclatura' => $nomenclatura->id]),
                    'urlEditar' => route("nomenclatura.edit", ['locale' => app()->getLocale(), 'nomenclatura' => $nomenclatura->id]),
                    'urlEliminar' => route("nomenclatura.destroy", ['locale' => app()->getLocale(), 'nomenclatura' => $nomenclatura->id])
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
        return response()->view('nomenclatura.crear', $this->respuesta, HttpStatus::OK);
    }
    public function store(Request $request)
    {
		Validator::make($request->all(), [
            'nomenclatura' => ['required', 'regex:/^([a-zA-Z]+(.*))+$/'],
            'abreviatura' => ['required', 'min:2', 'max:5'],
		])->validate();
		$nomenclatura = new Nomenclatura();
		$nomenclatura->nomenclatura = $request->nomenclatura;
		$nomenclatura->abreviatura = $request->abreviatura;
		try {
            $nomenclatura->save();
            $bitacora = new \App\Bitacora();
            $modulo = \App\Modulo::where('modulo', 'nomenclaturas')->first();
            $accion = \App\Accion::where('accion', 'Create')->first();
            $descripcion = "Created Nomenclature";
            $bitacora->registro($modulo->id, $nomenclatura->id, $accion->id, \Request::ip(), $descripcion);
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
