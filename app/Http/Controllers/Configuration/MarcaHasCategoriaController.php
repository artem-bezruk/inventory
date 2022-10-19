<?php
namespace App\Http\Controllers\Configuration;
use Validator;
use App\MarcaByCategoria;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Enums\HttpStatus;
class MarcaHasCategoriaController extends Controller
{
    protected $respuesta = [];
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('marcascategoria.index');
	}
	public function marcas_has_categorias (Request $request)
	{
		try {
            $all = MarcaByCategoria::where('eliminado', 0)->get();
            $this->respuesta["data"] = [];
            foreach ($all as $marcacategoria) {
                $this->respuesta["data"][] = (object) [
                    'id' => $marcacategoria->id,
					'marca' => __($marcacategoria->marca()->marca),
					'categoria' => __($marcacategoria->categoria()->categoria),
                    'urlMostrar' => route("marcacategoria.show", ['locale' => app()->getLocale(), 'marcacategoria' => $marcacategoria->id]),
                    'urlEditar' => route("marcacategoria.edit", ['locale' => app()->getLocale(), 'marcacategoria' => $marcacategoria->id]),
                    'urlEliminar' => route("marcacategoria.destroy", ['locale' => app()->getLocale(), 'marcacategoria' => $marcacategoria->id])
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
			"marcas" => \App\Marca::where('eliminado', 0)->get(),
			"categorias" => \App\Categoria::where('eliminado', 0)->get(),
		];
        return response()->view('marcascategoria.crear', $this->respuesta, HttpStatus::OK);
    }
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'categoria' => ['required', 'numeric'],
            'marca' => ['required', 'numeric'],
		])->validate();
		$marcacategoria = new MarcaByCategoria();
		$marcacategoria->marca_id = $request->marca;
		$marcacategoria->categoria_id = $request->categoria;
        try {
            $marcacategoria->save();
            $bitacora = new \App\Bitacora();
            $modulo = \App\Modulo::where('modulo', 'marcas_has_categorias')->first();
            $accion = \App\Accion::where('accion', 'Create')->first();
            $descripcion = "Created Mark by Category";
            $bitacora->registro($modulo->id, $marcacategoria->id, $accion->id, \Request::ip(), $descripcion);
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
            $marcacategoria = MarcaByCategoria::find($id);
            if (!empty($marcacategoria)) {
                $this->respuesta["data"] = (object) [
					"marca" => __($marcacategoria->marca()->marca),
					"categoria" => __($marcacategoria->categoria()->categoria),
                ];
                return response()->view('marcascategoria.mostrar', $this->respuesta, HttpStatus::OK);
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
    public function edit($locale, $id)
    {
        try {
            $marcacategoria = MarcaByCategoria::find($id);
            if (!empty($marcacategoria)) {
                $this->respuesta["data"] = (object) [
                    'id' => $marcacategoria->id,
					'marca' => $marcacategoria->marca_id,
					'categoria' => $marcacategoria->categoria_id,
				];
				$this->respuesta["extras"] = (object) [
					"marcas" => \App\Marca::where('eliminado', 0)->get(),
					"categorias" => \App\Categoria::where('eliminado', 0)->get(),
				];
                return response()->view('marcascategoria.editar', $this->respuesta, HttpStatus::OK);
            }
            else {
                $httpStatus = HttpStatus::NOCONTENT;
            }
        } catch (\Exception $e) {
            $this->respuesta["message"] = $e->getMessage() ?? HttpStatus::ERROR();
            $httpStatus = HttpStatus::ERROR;
        }
        return response()->json($this->respuesta, $httpStatus);
    }
    public function update(Request $request, $locale, $id)
    {
        Validator::make($request->all(), [
            'categoria' => ['required', 'numeric'],
            'marca' => ['required', 'numeric'],
		])->validate();
		$marcacategoria = MarcaByCategoria::find($id);
		$marcacategoria->marca_id = $request->marca;
		$marcacategoria->categoria_id = $request->categoria;
		try {
        	if ($marcacategoria->isDirty()) {
            	$marcacategoria->save();
                $bitacora = new \App\Bitacora();
                $modulo = \App\Modulo::where('modulo', 'marcas_has_categorias')->first();
                $accion = \App\Accion::where('accion', 'Update')->first();
                $descripcion = "Updated Mark by Category";
            	$bitacora->registro($modulo->id, $marcacategoria->id, $accion->id, \Request::ip(), $descripcion);
                $httpStatus = HttpStatus::OK;
                $this->respuesta["mensaje"] = HttpStatus::OK();
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
    public function destroy($id)
    {
    }
    public function marcascategorias ($locale, $categoria)
    {
        try {
            $resultado = MarcaByCategoria::where('categoria_id', $categoria)->where('eliminado', 0)->get();
            if (empty($resultado)) {
                $httpStatus = HttpStatus::NOCONTENT;
            }
            else {
                $marcas = [];
                foreach ($resultado as $value) {
                    $aux = [
                        'id' => $value->marca()->id,
                        'marca' => __($value->marca()->marca)
                    ];
                    array_push($marcas, $aux);
                }
                $httpStatus = HttpStatus::OK;
                $this->respuesta["marcas"] = $marcas;
            }
        } catch (\Exception $e) {
            $httpStatus = HttpStatus::ERROR;
            $this->respuesta["mensaje"] = HttpStatus::ERROR();
        }
        return response($this->respuesta, $httpStatus);
    }
}
