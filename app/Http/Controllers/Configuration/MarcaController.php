<?php
namespace App\Http\Controllers\Configuration;
use Validator;
use App\Marca;
use App\Enums\HttpStatus;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class MarcaController extends Controller
{
	protected $respuesta = [];
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index ()
    {
    	return view('marca.index');
    }
    public function marcas (Request $request)
    {
    	try {
            $all = Marca::where('eliminado', 0)->get();
            $this->respuesta["data"] = [];
            foreach ($all as $marca) {
                $this->respuesta["data"][] = (object) [
                    'id' => $marca->id,
                    'marca' => __($marca->marca),
                    'urlMostrar' => route("marca.show", ['locale' => app()->getLocale(), 'marca' => $marca->id]),
                    'urlEditar' => route("marca.edit", ['locale' => app()->getLocale(), 'marca' => $marca->id]),
                    'urlEliminar' => route("marca.destroy", ['locale' => app()->getLocale(), 'marca' => $marca->id])
                ];
            }
            if (empty($this->respuesta["data"])) {
                $httpStatus = HttpStatus::NOCONTENT;
            }
            else {
                $httpStatus = HttpStatus::OK;
            }
        } catch (\Exception $e) {
            $this->respuesta["mensaje"] = $e->getMessage()?? HttpStatus::ERROR();
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
