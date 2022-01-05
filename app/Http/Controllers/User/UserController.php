<?php
namespace App\Http\Controllers\User;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Enums\HttpStatus;
use Illuminate\Database\QueryException;
class UserController extends Controller
{
    protected $respuesta = [];
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('user.index');
    }
    public function users(Request $request)
    {
        $this->respuesta["data"] = [];
        $all = User::all();
        foreach ($all as $user) {
            if ($user->estatu()->first()->id == 1) {
                $color = "success";
            }
            else {
                $color = "danger";
            }
            $fecha_registro = new \DateTime($user->fecha_registro);
            $this->respuesta["data"][] = [
                'id' => $user->id,
                'nombre' => $user->nombre . ' ' . $user->apellido,
                'genero' => __($user->genero()->first()->genero),
                'rol' => __($user->rol()->first()->rol),
                'estatus' => "<div class='badge bg-" . $color . "'>" . __($user->estatu()->first()->estado) . "</div>",
                'fecha_registro' => $fecha_registro->format('d-m-Y H:i:s'),
                'urlMostrar' => route('user.show', ['locale' => app()->getLocale(), 'user' => $user->id])
            ];
        }
        if (empty($this->respuesta["data"])) {
            $httpStatus = HttpStatus::NOCONTENT;
        }
        else {
            $httpStatus = HttpStatus::OK;
        }
        return response()->json($this->respuesta, $httpStatus);
    }
    public function create()
    {
    }
    public function store(Request $request)
    {
    }
    public function show($local, $id)
    {
        $this->respuesta["data"] = [];
        $user = User::find($id);
        if (!empty($user)) {
            foreach ($user as $value) {
                $fecha_registro = new \DateTime($user->fecha_registro);
                $fecha_modificacion = '';
                if ($user->fecha_modificacion) {
                    $aux = new \DateTime($user->fecha_modificacion);
                    $fecha_modificacion = $aux->format('d-m-Y H:i:s');
                }
                $this->respuesta["data"] = (object) [
                    'username' => $user->username,
                    'nombre' => $user->nombre,
                    'apellido' => $user->apellido,
                    'cedula' => $user->cedula,
                    'genero' => __($user->genero()->first()->genero),
                    'rol' => __($user->rol()->first()->rol),
                    'estatus' => __($user->estatu()->first()->estado),
                    'fecha_registro' => $fecha_registro->format('d-m-Y H:i:s'),
                    'fecha_modificacion' => $fecha_modificacion
                ];
            }
            return response()->view('user.mostrar', $this->respuesta, HttpStatus::OK);
        }
        return response()->json($this->respuesta, HttpStatus::NOCONTENT);
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
    public function profile ($id)
    {
        return view('user.perfil');
    }
}
