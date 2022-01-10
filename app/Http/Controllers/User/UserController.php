<?php
namespace App\Http\Controllers\User;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Enums\HttpStatus;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
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
        try {
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
                    'nombre' => ucwords($user->nombre) . ' ' . ucwords($user->apellido),
                    'genero' => __($user->genero()->first()->genero),
                    'rol' => __($user->rol()->first()->rol),
                    'estatus' => "<div class='badge badge-pill badge-" . $color . "'>" . __($user->estatu()->first()->estado) . "</div>",
                    'fecha_registro' => $fecha_registro->format('d-m-Y H:i:s'),
                    'urlMostrar' => route('user.show', ['locale' => app()->getLocale(), 'user' => $user->id]),
                    'urlEditar' => route('user.edit', ['locale' => app()->getLocale(), 'user' => $user->id])
                ];
            }
            if (empty($this->respuesta["data"])) {
                $httpStatus = HttpStatus::NOCONTENT;
            }
            else {
                $httpStatus = HttpStatus::OK;
                $this->respuesta["mensaje"] = HttpStatus::OK();
            }
        } catch (\Exception $e) {
            $httpStatus = HttpStatus::ERROR;
            $this->respuesta["mensaje"] = HttpStatus::ERROR();
        }
        return response()->json($this->respuesta, $httpStatus);
    }
    public function create()
    {
        $this->respuesta["extras"] = (object) [
            "generos" => \App\Genero::all(),
        ];
        return response()->view('user.crear', $this->respuesta, HttpStatus::OK);
    }
    public function store(Request $request)
    {
        return response()->json($request->all(), HttpStatus::Ok);
    }
    public function show($local, $id)
    {
        $this->respuesta["data"] = [];
        try {
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
        $this->respuesta["data"] = [];
        try {
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
                        'id' => $user->id,
                        'username' => $user->username,
                        'nombre' => $user->nombre,
                        'apellido' => $user->apellido,
                        'cedula' => $user->cedula,
                        'correo' => $user->correo,
                        'genero' => $user->genero_id,
                        'rol' => $user->rol_id,
                        'estatus' => $user->estatus_id,
                        'fecha_registro' => $fecha_registro->format('d-m-Y H:i:s'),
                        'fecha_modificacion' => $fecha_modificacion
                    ];
                }
                $this->respuesta["extras"] = (object) [
                    "generos" => \App\Genero::all(),
                    "estatus" => \App\Estatu::all(),
                ];
                return response()->view('user.editar', $this->respuesta, HttpStatus::OK);
            }
            else {
                $httpStatus = HttpStatus::NOCONTENT;
            }
        } catch (\Exception $e) {
            $httpStatus = HttpStatus::ERROR;
            $this->respuesta = HttpStatus::ERROR();
        }
        return response()->json($this->respuesta, $httpStatus);
    }
    public function update(Request $request, $locale, $id)
    {
        $fecha = new \Datetime('now');
        $user = User::find($id);
        switch ($request->editar) {
            case 1:
                $user->nombre = $request->nombre;
                $user->apellido = $request->apellido;
                $user->genero_id = $request->genero;
                $user->estatus_id = $request->estatus;
                $user->correo = $request->correo;
                break;
            case 2:
                $user->password = Hash::make($request->password);
                break;
        }
        try {
            if ($user->isDirty()) {
                $user->fecha_modificacion = $fecha;
                $user->save();
                $httpStatus = HttpStatus::OK;
                $this->respuesta["mensaje"] = HttpStatus::OK();
            }
            else {
                $httpStatus = HttpStatus::NOCONTENT;
            }
        } catch (QueryException $qe) {
            $httpStatus = HttpStatus::ERROR;
        }
        return response()->json($this->respuesta, $httpStatus);
    }
    public function destroy($id)
    {
    }
    public function profile ($id)
    {
        return view('user.perfil');
    }
}
