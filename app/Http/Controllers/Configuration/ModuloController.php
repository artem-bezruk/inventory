<?php
namespace App\Http\Controllers\Configuration;
use Validator;
use App\Modulo;
use App\Enums\HttpStatus;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class ModuloController extends Controller
{
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
