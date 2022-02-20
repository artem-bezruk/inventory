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
            $descripcion = "Created Bien";
            $bitacora->registro($modulo->id, $bien->id, $accion->id, \Request::ip(), $descripcion);
            $httpStatus = HttpStatus::CREATED;
            $this->respuesta["mensaje"] = HttpStatus::CREATED();
        } catch (\Exception $e) {
            $httpStatus = HttpStatus::ERROR;
            $this->respuesta["mensaje"] = HttpStatus::ERROR();
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
}
