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
        try {
            $all = User::where('eliminado', 0)->get();
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
                    'urlEditar' => route('user.edit', ['locale' => app()->getLocale(), 'user' => $user->id]),
                    'urlEliminar' => route('user.destroy', ['locale' => app()->getLocale(), 'user' => $user->id]),
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
            "roles" => \App\Rol::all(),
        ];
        return response()->view('user.crear', $this->respuesta, HttpStatus::OK);
    }
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'nombre' => ['required', 'regex:/^([a-zA-Z])+((\s*)+([a-zA-Z]*)*)+$/'],
            'apellido' => ['required', 'regex:/^([a-zA-Z])+((\s*)+([a-zA-Z]*)*)+$/'],
            'cedula' => ['required', 'numeric', 'digits_between:7,8', 'unique:users'],
            'genero' => ['required', 'numeric'],
            'correo' => ['required', 'regex:/^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/', 'unique:users'],
            'username' => ['required', 'regex:/^([a-zA-Z]|[0-9])*$/', 'unique:users'],
            'rol' => ['required', 'numeric'],
            'password' => ['required'],
            'password_confirmation' => ['required', 'same:password'],
        ])->validate();
        $estatus = \App\Estatu::where('estado', 'Active')->first();
        $user = new User();
        $user->nombre = trim($request->nombre);
        $user->apellido = trim($request->apellido);
        $user->cedula = $request->cedula;
        $user->genero_id = $request->genero;
        $user->estatus_id = $estatus->id;
        $user->correo = trim($request->correo);
        $user->rol_id = $request->rol;
        $user->username = trim($request->username);
        $user->password = Hash::make($request->password);
        $user->fecha_registro = new \DateTime('now');
        try {
            $user->save();
            $httpStatus = HttpStatus::CREATED;
            $this->respuesta["mensaje"] = HttpStatus::CREATED();
        } catch (QueryException $e) {
            $httpStatus = HttpStatus::ERROR;
            $this->respuesta["mensaje"] = HttpStatus::ERROR();
        }
        return response()->json($this->respuesta, $httpStatus);
    }
    public function show($local, $id)
    {
        try {
            $user = User::find($id);
            if (!empty($user)) {
                $this->respuesta["data"] = [];
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
        try {
            $user = User::find($id);
            if (!empty($user)) {
                $this->respuesta["data"] = [];
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
                $this->respuesta["extras"] = (object) [
                    "generos" => \App\Genero::all(),
                    "roles" => \App\Rol::all(),
                    "estatus" => \App\Estatu::all(),
                ];
                return response()->view('user.editar', $this->respuesta, HttpStatus::OK);
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
    public function update(Request $request, $locale, $id)
    {
        Validator::make($request->all(), [
            'nombre' => ['required_if:editar,1', 'regex:/^([a-zA-Z])+((\s*)+([a-zA-Z]*)*)+$/'],
            'apellido' => ['required_if:editar,1', 'regex:/^([a-zA-Z])+((\s*)+([a-zA-Z]*)*)+$/'],
            'genero' => ['required_if:editar,1', 'numeric'],
            'correo' => ['required_if:editar,1', 'regex:/^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/'],
            'rol' => ['required_if:editar,2', 'numeric'],
            'password' => ['required_if:editar,2'],
            'password_confirmation' => ['required_if:editar,2', 'same:password'],
        ])->validate();
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
                $user->rol_id = $request->rol;
                $user->password = Hash::make($request->password);
                break;
        }
        if ($user->isDirty('correo')) {
            Validator::make($request->all(), [
                'correo' => ['unique:users'],
            ])->validate();
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
            $this->respuesta["mensaje"] = HttpStatus::ERROR();
        }
        return response()->json($this->respuesta, $httpStatus);
    }
    public function destroy($locale, $id)
    {
        $user = User::find($id);
        $fecha = new \Datetime('now');
        try {
            if ($user->rol()->first()->rol == "Administrator") {
                $administradores = User::where('rol_id', $user->rol()->first()->id)->where('eliminado', 0)->count();
                if ($administradores == 1) {
                    $httpStatus = HttpStatus::ERROR;
                    $this->respuesta["mensaje"] = __('Can\'t delete the last Administrator');
                }
                else {
                    $user->eliminado = 1;
                    $user->fecha_modificacion = $fecha;
                    $user->save();
                    $httpStatus = HttpStatus::OK;
                    $this->respuesta["mensaje"] = HttpStatus::OK() . $administradores;
                }
            }
            else {
                $user->eliminado = 1;
                $user->fecha_modificacion = $fecha;
                $user->save();
                $httpStatus = HttpStatus::OK;
                $this->respuesta["mensaje"] = HttpStatus::OK();
            }
        } catch (\Exception $e) {
            $httpStatus = HttpStatus::ERROR;
            $this->respuesta["mensaje"] = $e->getMessage();
        }
        return response()->json($this->respuesta, $httpStatus);
    }
    public function profile ($id)
    {
        try {
            $user = User::find(auth()->user()->id);
            if (!empty($user)) {
                $this->respuesta["data"] = [];
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
                    'genero' => $user->genero()->first()->genero,
                    'rol' => $user->rol()->first()->rol,
                    'estatus' => $user->estatu()->first()->estado,
                    'fecha_registro' => $fecha_registro->format('d-m-Y H:i:s'),
                    'fecha_modificacion' => $fecha_modificacion
                ];
                return view('user.perfil', $this->respuesta);
            }
            else {
                $mensaje = (object) [
                    "tipo" => 'i',
                    "mensaje" => __('We\'ve problems to show your data')
                ];
                session()->flash('alerta', $mensaje);
            }
        } catch (\Exception $e) {
            $mensaje = (object) [
                "tipo" => 'e',
                "mensaje" => __('Oops! Something went wrong')
            ];
            session()->flash('alerta', $mensaje);
        }
        return redirect()->route('dashboard', ['locale' => app()->getLocale()]);
    }
}
