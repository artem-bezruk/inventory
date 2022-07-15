<?php
namespace App\Http\Controllers\Configuration;
use Validator;
use App\Genero;
use App\Enums\HttpStatus;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class GeneroController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index ()
    {
    	return view('genero.index');
    }
    public function generos (Request $request)
    {
        try {
            $all = Genero::where('eliminado', 0)->get();
            $this->respuesta["data"] = [];
            foreach ($all as $genero) {
                $this->respuesta["data"][] = (object) [
                    'id' => $genero->id,
                    'genero' => __($genero->genero),
                    'urlMostrar' => route("genero.show", ['locale' => app()->getLocale(), 'genero' => $genero->id]),
                    'urlEditar' => route("genero.edit", ['locale' => app()->getLocale(), 'genero' => $genero->id]),
                    'urlEliminar' => route("genero.destroy", ['locale' => app()->getLocale(), 'genero' => $genero->id])
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
