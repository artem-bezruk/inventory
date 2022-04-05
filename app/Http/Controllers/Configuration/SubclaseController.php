<?php
namespace App\Http\Controllers\Configuration;
use Validator;
use App\Subclase;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Enums\HttpStatus;
class SubclaseController extends Controller
{
	protected $respuesta = [];
	public function __construct()
	{
		$this->middleware('auth');
	}
	public function index()
	{
		return view('subclase.index');
	}
	public function listaSubclases(Request $request)
	{
		try {
			$all = Subclase::where('eliminado', 0)->get();
			$this->respuesta["data"] = [];
			foreach ($all as $subclase) {
				$this->respuesta["data"][] = (object) [
					'id' => $subclase->id,
					'clase' => __($subclase->clase()->clase),
					'subclase' => __($subclase->sub_clase),
					'urlMostrar' => route("subclase.show", ['locale' => app()->getLocale(), 'subclase' => $subclase->id]),
					'urlEditar' => route("subclase.edit", ['locale' => app()->getLocale(), 'subclase' => $subclase->id]),
					'urlEliminar' => route("subclase.destroy", ['locale' => app()->getLocale(), 'subclase' => $subclase->id])
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
			"clases" => \App\Clase::where('eliminado', 0)->get(),
		];
		return response()->view('subclase.crear', $this->respuesta, HttpStatus::OK);
	}
	public function store(Request $request)
	{
		Validator::make($request->all(), [
            'clase' => ['required', 'numeric'],
            'subclase' => ['required', 'regex:/^([a-zA-Z]+(.*))+$/'],
        ])->validate();
        $subclase = new Subclase;
        $subclase->clase_id = $request->clase;
        $subclase->sub_clase = $request->subclase;
        try {
        	$subclase->save();
            $bitacora = new \App\Bitacora();
            $modulo = \App\Modulo::where('modulo', 'sub_clases')->first();
            $accion = \App\Accion::where('accion', 'Create')->first();
            $descripcion = "Created Subclass";
            $bitacora->registro($modulo->id, $subclase->id, $accion->id, \Request::ip(), $descripcion);
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
	public function subclases ($locale, $clase)
	{
		try {
			$resultado = Subclase::where('clase_id', $clase)->where('eliminado', 0)->get();
			if (empty($resultado)) {
				$httpStatus = HttpStatus::NOCONTENT;
			}
			else {
				$subclases = [];
				foreach ($resultado as $value) {
					$aux = [
						'id' => $value->id,
						'sub_clase' => __($value->sub_clase)
					];
					array_push($subclases, $aux);
				}
				$httpStatus = HttpStatus::OK;
				$this->respuesta["subclases"] = $subclases;
			}
		} catch (\Exception $e) {
			$httpStatus = HttpStatus::ERROR;
			$this->respuesta["mensaje"] = HttpStatus::ERROR();
		}
		return response()->json($this->respuesta, $httpStatus);
	}
}
