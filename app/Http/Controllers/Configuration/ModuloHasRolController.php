<?php
namespace App\Http\Controllers\Configuration;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class ModuloHasRolController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index ()
    {
    	return view('modulorol.index');
    }
}
