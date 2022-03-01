<?php
namespace App\Http\Controllers\Bien;
use Validator;
use App\Bien;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Enums\HttpStatus;
class BienController extends Controller
{
    protected $respuesta = [];
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('bien.index');
    }
    public function bienes(Request $request)
    {
        try {
            $all = Bien::where('eliminado', 0)->get();
            $this->respuesta["data"] = [];
            foreach ($all as $bien) {
                if ($bien->capacidad_id) {
                    $capacidad = $bien->capacidad()->capacidad . " " . $bien->capacidad()->nomenclatura()->nomenclatura . " (" . $bien->capacidad()->nomenclatura()->abreviatura . ")";
                }
                else {
                    $capacidad = __('Doesn\'t apply');
                }
                $this->respuesta["data"][] = (object) [
                    'id' => $bien->id,
                    'clase' => __($bien->subcategoria()->categoria()->subclase()->clase()->clase),
                    'subclase' => __($bien->subcategoria()->categoria()->subclase()->sub_clase),
                    'categoria' => __($bien->subcategoria()->categoria()->categoria),
                    'subcategoria' => __($bien->subcategoria()->sub_categoria),
                    'modelo' => $bien->modelo,
                    'marca' => __($bien->marca()->marca),
                    'capacidad' => $capacidad,
                    'urlMostrar' => route('bien.show', ['locale' => app()->getLocale(), 'bien' => $bien->id]),
                    'urlEditar' => route('bien.edit', ['locale' => app()->getLocale(), 'bien' => $bien->id]),
                    'urlEliminar' => route('bien.destroy', ['locale' => app()->getLocale(), 'bien' => $bien->id])
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
            "capacidades" => \App\Capacidad::where('eliminado', 0)->get(),
        ];
        return response()->view('bien.crear', $this->respuesta, HttpStatus::OK);
    }
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'clase' => ['required', 'numeric'],
            'subclase' => ['required', 'numeric'],
            'categoria' => ['required', 'numeric'],
            'subcategoria' => ['required', 'numeric'],
            'marca' => ['required', 'numeric'],
            'ver_capacidad' => ['string'],
            'capacidad' => ['required_if:ver_capacidad,true', 'numeric'],
            'modelo' => ['required'],
            'cantidad' => ['required'],
            'modelo' => ['required', 'regex:/^([a-zA-Z0-9]+(.*))+$/'],
            'cantidad' => ['required', 'numeric'],
        ])->validate();
        $bien = new Bien();
        $bien->marca_id = $request->marca;
        $bien->sub_categoria_id = $request->subcategoria;
        $bien->modelo = $request->modelo;
        $bien->capacidad_id = $request->capacidad;
        $bien->cantidad = $request->cantidad;
        $bien->usuario_registra = auth()->user()->id;
        $bien->fecha_registro = new \DateTime('now');
        try {
            $bien->save();
            $bitacora = new \App\Bitacora();
            $modulo = \App\Modulo::where('modulo', 'bienes')->first();
            $accion = \App\Accion::where('accion', 'Create')->first();
            $descripcion = "Created Property";
            $bitacora->registro($modulo->id, $bien->id, $accion->id, \Request::ip(), $descripcion);
            $httpStatus = HttpStatus::CREATED;
            $this->respuesta["mensaje"] = HttpStatus::CREATED();
        } catch (\Exception $e) {
            $httpStatus = HttpStatus::ERROR;
            $this->respuesta["mensaje"] = HttpStatus::ERROR();
        }
        return response()->json($this->respuesta, $httpStatus);
    }
    public function show($locale, $id)
    {
        try {
            $bien = Bien::find($id);
            if (!empty($bien)) {
                $fecha_registro = new \DateTime($bien->fecha_registro);
                $fecha_modificacion = '';
                if ($bien->capacidad_id) {
                    $capacidad = $bien->capacidad()->capacidad . " " . $bien->capacidad()->nomenclatura()->nomenclatura . " (" . $bien->capacidad()->nomenclatura()->abreviatura . ")";
                }
                else {
                    $capacidad = "";
                }
                if ($bien->fecha_modificacion) {
                    $aux = new \DateTime($bien->fecha_modificacion);
                    $fecha_modificacion = $aux->format('d-m-Y H:i:s');
                }
                $this->respuesta["data"] = (object) [
                    'clase' => __($bien->subcategoria()->categoria()->subclase()->clase()->clase),
                    'subclase' => __($bien->subcategoria()->categoria()->subclase()->sub_clase),
                    'categoria' => __($bien->subcategoria()->categoria()->categoria),
                    'subcategoria' => __($bien->subcategoria()->sub_categoria),
                    'marca' => __($bien->marca()->marca),
                    'modelo' => $bien->modelo,
                    'capacidad' => $capacidad,
                    'cantidad' => $bien->cantidad,
                    'fecha_registro' => $fecha_registro->format('d-m-Y H:i:s'),
                    'fecha_modificacion' => $fecha_modificacion,
                ];
                return response()->view('bien.mostrar', $this->respuesta, HttpStatus::OK);
            }
            else {
                $httpStatus = HttpStatus::NOCONTENT;
            }
        } catch (\Exception $e) {
            $httpStatus = HttpStatus::ERROR;
            $this->respuesta["mensaje"] = HttpStatus::ERROR();
        }
        return response()->json($this->respuesta, $httpStatus);
    }
    public function edit($locale, $id)
    {
        try {
            $bien = Bien::find($id);
            if (!empty($bien)) {
                $this->respuesta["data"] = (object) [
                    'id' => $bien->id,
                    'clase' => $bien->subcategoria()->categoria()->subclase()->clase()->id,
                    'subclase' => $bien->subcategoria()->categoria()->subclase()->id,
                    'categoria' => $bien->subcategoria()->categoria()->id,
                    'subcategoria' => $bien->sub_categoria_id,
                    'marca' => $bien->marca_id,
                    'modelo'=> $bien->modelo,
                    'cantidad' => $bien->cantidad,
                    'capacidad' => $bien->capacidad_id,
                ];
                $this->respuesta["extras"] = (object) [
                    "clases" => \App\Clase::where('eliminado', 0)->get(),
                    "subclases" => \App\Subclase::where('eliminado', 0)->where('clase_id', $this->respuesta["data"]->clase)->get(),
                    "categorias" => \App\Categoria::where('eliminado', 0)->where('sub_clase_id', $this->respuesta["data"]->subclase)->get(),
                    "subcategorias" => \App\Subcategoria::where('eliminado', 0)->where('categoria_id', $this->respuesta["data"]->categoria)->get(),
                    "marcas" => \App\MarcaByCategoria::where('eliminado', 0)->where('categoria_id', $this->respuesta["data"]->categoria)->get(),
                    "capacidades" => \App\Capacidad::where('eliminado', 0)->get(),
                ];
                return response()->view('bien.editar', $this->respuesta, HttpStatus::OK);
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
            'clase' => ['required', 'numeric'],
            'subclase' => ['required', 'numeric'],
            'categoria' => ['required', 'numeric'],
            'subcategoria' => ['required', 'numeric'],
            'marca' => ['required', 'numeric'],
            'ver_capacidad' => ['string'],
            'capacidad' => ['required_if:ver_capacidad,true', 'numeric'],
            'modelo' => ['required'],
            'cantidad' => ['required'],
            'modelo' => ['required', 'regex:/^([a-zA-Z0-9]+(.*))+$/'],
            'cantidad' => ['required', 'numeric'],
        ])->validate();
        $bien = Bien::find($id);
        $bien->marca_id = $request->marca;
        $bien->sub_categoria_id = $request->subcategoria;
        $bien->modelo = $request->modelo;
        $bien->capacidad_id = $request->capacidad;
        $bien->cantidad = $request->cantidad;
        try {
            if ($bien->isDirty()) {
                $bien->usuario_modifica = auth()->user()->id;
                $bien->fecha_modificacion = new \DateTime('now');
                $bien->save();
                $bitacora = new \App\Bitacora();
                $modulo = \App\Modulo::where('modulo', 'bienes')->first();
                $accion = \App\Accion::where('accion', 'Update')->first();
                $descripcion = "Updated Property";
                $bitacora->registro($modulo->id, $bien->id, $accion->id, \Request::ip(), $descripcion);
                $httpStatus = HttpStatus::OK;
                $this->respuesta["mensaje"] = HttpStatus::OK();
            }
            else {
                $httpStatus = HttpStatus::NOCONTENT;
            }
        } catch (\Exception $e) {
            $this->respuesta["mensaje"] = $e->getMessage()?? HttpStatus::ERROR();
            $httpStatus = HttpStatus::ERROR;
        }
        return response()->json($this->respuesta, $httpStatus);
    }
    public function destroy($locale, $id)
    {
        $bien = Bien::find($id);
        $fecha = new \Datetime('now');
        try {
            $bien->eliminado = 1;
            $bien->fecha_modificacion = $fecha;
            $bien->save();
            $bitacora = new \App\Bitacora();
            $modulo = \App\Modulo::where('modulo', 'bienes')->first();
            $accion = \App\Accion::where('accion', 'Delete')->first();
            $descripcion = "Deleted Property";
            $bitacora->registro($modulo->id, $bien->id, $accion->id, \Request::ip(), $descripcion);
            $httpStatus = HttpStatus::OK;
            $this->respuesta["mensaje"] = HttpStatus::OK();
        } catch (\Exception $e) {
            $httpStatus = HttpStatus::ERROR;
            $this->respuesta["mensaje"] = $e->getMessage();
        }
        return response()->json($this->respuesta, $httpStatus);
    }
}
