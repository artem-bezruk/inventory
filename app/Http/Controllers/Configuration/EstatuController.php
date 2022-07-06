<?php
namespace App\Http\Controllers\Configuration;
use Validator;
use App\Estatu;
use App\Enums\HttpStatus;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class EstatuController extends Controller
{
	protected $respuesta = [];
	public function __construct()
	{
		$this->middleware('auth');
	}
	public function index ()
	{
		return view('estatu.index');
	}
	public function estatus(Request $request)
	{
		try {
			$all = Estatu::where('eliminado', 0)->get();
			$this->respuesta["data"] = [];
			foreach ($all as $estatu) {
				$this->respuesta["data"][] = (object) [
					'id' => $estatu->id,
					'estado' => __($estatu->estado),
					'urlMostrar' => route("estatu.show", ['locale' => app()->getLocale(), 'estatu' => $estatu->id]),
					'urlEditar' => route("estatu.edit", ['locale' => app()->getLocale(), 'estatu' => $estatu->id]),
					'urlEliminar' => route("estatu.destroy", ['locale' => app()->getLocale(), 'estatu' => $estatu->id])
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
		return response()->view('estatu.crear', $this->respuesta, HttpStatus::OK);
	}
	public function store(Request $request)
	{
		Validator::make($request->all(), [
            'estatu' => ['required', 'regex:/^([a-zA-Z]+(.*))+$/'],
        ])->validate();
        $estatu = new Estatu();
        $estatu->estado = $request->estatu;
        try {
            $estatu->save();
            $bitacora = new \App\Bitacora();
            $modulo = \App\Modulo::where('modulo', 'estatus')->first();
            $accion = \App\Accion::where('accion', 'Create')->first();
            $descripcion = "Created Statu";
            $bitacora->registro($modulo->id, $estatu->id, $accion->id, \Request::ip(), $descripcion);
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
            $estatu = Estatu::find($id);
            if (!empty($estatu)) {
                $this->respuesta["data"] = (object) [
                    "estatu" => __($estatu->estado)
                ];
                return response()->view('estatu.mostrar', $this->respuesta, HttpStatus::OK);
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
