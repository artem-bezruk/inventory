<?php
namespace App\Http\Controllers\Configuration;
use App\Rol;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class RolController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index ()
    {
    	return view('rol.index');
    }
}
