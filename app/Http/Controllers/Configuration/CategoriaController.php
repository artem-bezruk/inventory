<?php
namespace App\Http\Controllers\Configuration;
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
