<?php
namespace App\Http\Controllers\Configuration;
use App\Subclase;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Enums\HttpStatus;
class SubclaseController extends Controller
{
    protected $respuesta = [];
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('subclase.index');
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
    public function subclases ($locale, $clase)
    {
        try {
            $resultado = Subclase::where('clase_id', $clase)->where('eliminado', 0)->get();
            if (empty($resultado)) {
                $httpStatus = HttpStatus::NOCONTENT;
            }
            else {
                $subclases = [];
                foreach ($resultado as $value) {
                    $aux = [
                        'id' => $value->id,
                        'sub_clase' => __($value->sub_clase)
                    ];
                    array_push($subclases, $aux);
                }
                $httpStatus = HttpStatus::OK;
                $this->respuesta["subclases"] = $subclases;
            }
        } catch (\Exception $e) {
            $httpStatus = HttpStatus::ERROR;
            $this->respuesta["mensaje"] = HttpStatus::ERROR();
        }
        return response()->json($this->respuesta, $httpStatus);
    }
}
