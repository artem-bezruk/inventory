<?php
namespace App\Http\Controllers\Configuration;
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
