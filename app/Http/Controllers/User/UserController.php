<?php
namespace App\Http\Controllers\User;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Enums\HttpStatus;
class UserController extends Controller
{
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
        $users = [];
        $users["data"] = [];
        $all = User::all();
        foreach ($all as $user) {
            if ($user->estatu()->first()->id == 1) {
                $color = "success";
            }
            else {
                $color = "danger";
            }
            $fecha_registro = new \DateTime($user->fecha_registro);
            $users["data"][] = [
                'id' => $user->id,
                'nombre' => $user->nombre . ' ' . $user->apellido,
                'genero' => __($user->genero()->first()->genero),
                'rol' => __($user->rol()->first()->rol),
                'estatus' => "<div class='badge bg-" . $color . "'>" . __($user->estatu()->first()->estado) . "</div>",
                'fecha_registro' => $fecha_registro->format('d-m-Y H:i:s'),
            ];
        }
        if (empty($users["data"])) {
            $httpStatus = HttpStatus::NOCONTENT;
        }
        else {
            $httpStatus = HttpStatus::OK;
        }
        return response()->json($users, $httpStatus);
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
    public function profile ($id)
    {
        return view('user.perfil');
    }
}
