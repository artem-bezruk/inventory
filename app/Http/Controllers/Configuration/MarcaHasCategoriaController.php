<?php
namespace App\Http\Controllers\Configuration;
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
