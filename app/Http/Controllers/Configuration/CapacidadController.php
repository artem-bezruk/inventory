<?php
namespace App\Http\Controllers\Configuration;
use Validator;
use App\Capacidad;
use App\Enums\HttpStatus;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class CapacidadController extends Controller
{
	protected $respuesta = [];
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index ()
    {
    	return view('capacidad.index');
    }
    public function capacidades (Request $request)
    {
    	try {
            $all = Capacidad::where('eliminado', 0)->get();
            $this->respuesta["data"] = [];
            foreach ($all as $capacidad) {
                $this->respuesta["data"][] = (object) [
                    'id' => $capacidad->id,
                    'capacidad' => $capacidad->capacidad . " " . __($capacidad->nomenclatura()->nomenclatura) . " (" . $capacidad->nomenclatura()->abreviatura . ")",
                    'urlMostrar' => route("capacidad.show", ['locale' => app()->getLocale(), 'capacidad' => $capacidad->id]),
                    'urlEditar' => route("capacidad.edit", ['locale' => app()->getLocale(), 'capacidad' => $capacidad->id]),
                    'urlEliminar' => route("capacidad.destroy", ['locale' => app()->getLocale(), 'capacidad' => $capacidad->id])
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
