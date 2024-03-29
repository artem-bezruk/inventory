<?php
namespace App\Http\Controllers\Configuration;
use Validator;
use App\Subcategoria;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Enums\HttpStatus;
class SubcategoriaController extends Controller
{
    protected $respuesta = [];
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index ()
    {
        return view('subcategoria.index');
    }
    public function listaSubcategorias (Request $request)
    {
    	try {
			$all = Subcategoria::where('eliminado', 0)->get();
			$this->respuesta["data"] = [];
			foreach ($all as $subcategoria) {
				$this->respuesta["data"][] = (object) [
					'id' => $subcategoria->id,
					'clase' => __($subcategoria->categoria()->subclase()->clase()->clase),
					'subclase' => __($subcategoria->categoria()->subclase()->sub_clase),
					'categoria' => __($subcategoria->categoria()->categoria),
					'subcategoria' => __($subcategoria->sub_categoria),
					'urlMostrar' => route("subcategoria.show", ['locale' => app()->getLocale(), 'subcategoria' => $subcategoria->id]),
					'urlEditar' => route("subcategoria.edit", ['locale' => app()->getLocale(), 'subcategoria' => $subcategoria->id]),
					'urlEliminar' => route("subcategoria.destroy", ['locale' => app()->getLocale(), 'subcategoria' => $subcategoria->id])
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
        $this->respuesta["extras"] = (object) [
			"clases" => \App\Clase::where('eliminado', 0)->get(),
		];
		return response()->view('subcategoria.crear', $this->respuesta, HttpStatus::OK);
    }
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'clase' => ['required', 'numeric'],
            'subclase' => ['required', 'numeric'],
            'categoria' => ['required', 'numeric'],
            'subcategoria' => ['required', 'regex:/^([a-zA-Z]+(.*))+$/'],
        ])->validate();
        $subcategoria = new Subcategoria;
        $subcategoria->categoria_id = $request->categoria;
        $subcategoria->sub_categoria = $request->subcategoria;
        try {
        	$subcategoria->save();
            $bitacora = new \App\Bitacora();
            $modulo = \App\Modulo::where('modulo', 'sub_categorias')->first();
            $accion = \App\Accion::where('accion', 'Create')->first();
            $descripcion = "Created Subcategory";
            $bitacora->registro($modulo->id, $subcategoria->id, $accion->id, \Request::ip(), $descripcion);
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
            $subcategoria = Subcategoria::find($id);
            if (!empty($subcategoria)) {
                $this->respuesta["data"] = (object) [
                    "clase" => __($subcategoria->categoria()->subclase()->clase()->clase),
                    "subclase" => __($subcategoria->categoria()->subclase()->sub_clase),
                    "categoria" => __($subcategoria->categoria()->categoria),
                    "subcategoria" => __($subcategoria->sub_categoria)
                ];
                return response()->view('subcategoria.mostrar', $this->respuesta, HttpStatus::OK);
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
            $subcategoria = Subcategoria::find($id);
            if (!empty($subcategoria)) {
                $this->respuesta["data"] = (object) [
                    'id' => $subcategoria->id,
                    'clase' => $subcategoria->categoria()->subclase()->clase()->id,
                    'subclase' => $subcategoria->categoria()->subclase()->id,
                    'categoria' => $subcategoria->categoria_id,
                    'subcategoria' => $subcategoria->sub_categoria,
                ];
                $this->respuesta["extras"] = (object) [
                	'clases' => \App\Clase::where('eliminado', 0)->get(),
                	'subclases' => \App\Subclase::where('eliminado', 0)->where('clase_id', $subcategoria->categoria()->subclase()->clase_id)->get(),
                	'categorias' => \App\Categoria::where('eliminado', 0)->where('sub_clase_id', $subcategoria->categoria()->sub_clase_id)->get(),
                ];
                return response()->view('subcategoria.editar', $this->respuesta, HttpStatus::OK);
            }
            else {
                $httpStatus = HttpStatus::NOCONTENT;
            }
        } catch (\Exception $e) {
            $this->respuesta["message"] = HttpStatus::ERROR();
            $httpStatus = HttpStatus::ERROR;
        }
        return response()->json($this->respuesta, $httpStatus);
    }
    public function update(Request $request, $locale, $id)
    {
        Validator::make($request->all(), [
            'clase' => ['required', 'numeric'],
            'subclase' => ['required', 'numeric'],
            'categoria' => ['required', 'numeric'],
            'subcategoria' => ['required', 'regex:/^([a-zA-Z]+(.*))+$/'],
        ])->validate();
        $subcategoria = Subcategoria::find($id);
        $subcategoria->categoria_id = $request->categoria;
        $subcategoria->sub_categoria = $request->subcategoria;
        try {
        	if ($subcategoria->isDirty()) {
	        	$subcategoria->save();
	            $bitacora = new \App\Bitacora();
	            $modulo = \App\Modulo::where('modulo', 'sub_categorias')->first();
	            $accion = \App\Accion::where('accion', 'Update')->first();
	            $descripcion = "Updated Subcategory";
	            $bitacora->registro($modulo->id, $subcategoria->id, $accion->id, \Request::ip(), $descripcion);
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
    public function destroy($locale, $id)
    {
        $subcategoria = Subcategoria::find($id);
        try {
            $subcategoria->eliminado = 1;
            $subcategoria->save();
            $bitacora = new \App\Bitacora();
            $modulo = \App\Modulo::where('modulo', 'sub_categorias')->first();
            $accion = \App\Accion::where('accion', 'Delete')->first();
            $descripcion = "Deleted Subcategory";
            $bitacora->registro($modulo->id, $subcategoria->id, $accion->id, \Request::ip(), $descripcion);
            $httpStatus = HttpStatus::OK;
            $this->respuesta["mensaje"] = HttpStatus::OK();
        } catch (\Exception $e) {
            $httpStatus = HttpStatus::ERROR;
            $this->respuesta["mensaje"] = HttpStatus::ERROR();
        }
        return response()->json($this->respuesta, $httpStatus);
    }
    public function subcategorias ($locale, $categoria)
    {
        try {
            $resultado = Subcategoria::where('categoria_id', $categoria)->where('eliminado', 0)->get();
            if (empty($resultado)) {
                $httpStatus = HttpStatus::NOCONTENT;
            }
            else {
                $subcategorias = [];
                foreach ($resultado as $value) {
                    $aux = [
                        'id' => $value->id,
                        'sub_categoria' => __($value->sub_categoria)
                    ];
                    array_push($subcategorias, $aux);
                }
                $httpStatus = HttpStatus::OK;
                $this->respuesta["subcategorias"] = $subcategorias;
            }
        } catch (\Exception $e) {
            $httpStatus = HttpStatus::ERROR;
            $this->respuesta["mensaje"] = HttpStatus::ERROR();
        }
        return response()->json($this->respuesta, $httpStatus);
    }
}
