<?php
namespace App\Http\Controllers\Configuration;
use Validator;
use App\Categoria;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Enums\HttpStatus;
class CategoriaController extends Controller
{
    protected $respuesta = [];
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index ()
    {
        return view('categoria.index');
    }
    public function listaCategorias (Request $request)
    {
    	try {
			$all = Categoria::where('eliminado', 0)->get();
			$this->respuesta["data"] = [];
			foreach ($all as $categoria) {
				$this->respuesta["data"][] = (object) [
					'id' => $categoria->id,
					'clase' => __($categoria->subclase()->clase()->clase),
					'subclase' => __($categoria->subclase()->sub_clase),
					'categoria' => __($categoria->categoria),
					'urlMostrar' => route("categoria.show", ['locale' => app()->getLocale(), 'categoria' => $categoria->id]),
					'urlEditar' => route("categoria.edit", ['locale' => app()->getLocale(), 'categoria' => $categoria->id]),
					'urlEliminar' => route("categoria.destroy", ['locale' => app()->getLocale(), 'categoria' => $categoria->id])
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
		return response()->view('categoria.crear', $this->respuesta, HttpStatus::OK);
    }
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'clase' => ['required', 'numeric'],
            'subclase' => ['required', 'numeric'],
            'categoria' => ['required', 'regex:/^([a-zA-Z]+(.*))+$/'],
            'capacidad' => ['boolean'],
        ])->validate();
        $categoria = new Categoria;
        $categoria->sub_clase_id = $request->subclase;
        $categoria->categoria = $request->categoria;
        $categoria->ver_capacidad = $request->capacidad ?? false;
        try {
        	$categoria->save();
            $bitacora = new \App\Bitacora();
            $modulo = \App\Modulo::where('modulo', 'categorias')->first();
            $accion = \App\Accion::where('accion', 'Create')->first();
            $descripcion = "Created Category";
            $bitacora->registro($modulo->id, $categoria->id, $accion->id, \Request::ip(), $descripcion);
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
            $categoria = Categoria::find($id);
            if (!empty($categoria)) {
                $this->respuesta["data"] = (object) [
                    "clase" => __($categoria->subclase()->clase()->clase),
                    "subclase" => __($categoria->subclase()->sub_clase),
                    "categoria" => __($categoria->categoria),
                    "ver_capacidad" => $categoria->ver_capacidad,
                ];
                return response()->view('categoria.mostrar', $this->respuesta, HttpStatus::OK);
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
            $categoria = Categoria::find($id);
            if (!empty($categoria)) {
                $this->respuesta["data"] = (object) [
                    'id' => $categoria->id,
                    'clase' => $categoria->subclase()->clase()->id,
                    'subclase' => $categoria->sub_clase_id,
                    'categoria' => $categoria->categoria,
                    'capacidad' => $categoria->ver_capacidad
                ];
                $this->respuesta["extras"] = (object) [
                	'clases' => \App\Clase::where('eliminado', 0)->get(),
                	'subclases' => \App\Subclase::where('eliminado', 0)->where('clase_id', $categoria->subclase()->clase_id)->get(),
                ];
                return response()->view('categoria.editar', $this->respuesta, HttpStatus::OK);
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
            'categoria' => ['required', 'regex:/^([a-zA-Z]+(.*))+$/'],
            'capacidad' => ['boolean'],
        ])->validate();
        $categoria = Categoria::find($id);
        $categoria->sub_clase_id = $request->subclase;
        $categoria->categoria = $request->categoria;
        $categoria->ver_capacidad = $request->capacidad ? true : false;
        try {
            if ($categoria->isDirty()) {
                $categoria->save();
                $bitacora = new \App\Bitacora();
                $modulo = \App\Modulo::where('modulo', 'categorias')->first();
                $accion = \App\Accion::where('accion', 'Update')->first();
                $descripcion = "Updated Category";
                $bitacora->registro($modulo->id, $categoria->id, $accion->id, \Request::ip(), $descripcion);
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
    public function categorias ($locale, $subclase)
    {
        try {
            $resultado = Categoria::where('sub_clase_id', $subclase)->where('eliminado', 0)->get();
            if (empty($resultado)) {
                $httpStatus = HttpStatus::NOCONTENT;
            }
            else {
                $categorias = [];
                foreach ($resultado as $value) {
                    $aux = [
                        'id' => $value->id,
                        'categoria' => __($value->categoria),
                        'ver_capacidad' => $value->ver_capacidad
                    ];
                    array_push($categorias, $aux);
                }
                $httpStatus = HttpStatus::OK;
                $this->respuesta["categorias"] = $categorias;
            }
        } catch (\Exception $e) {
            $httpStatus = HttpStatus::ERROR;
            $this->respuesta["mensaje"] = HttpStatus::ERROR();
        }
        return response()->json($this->respuesta, $httpStatus);
    }
}
