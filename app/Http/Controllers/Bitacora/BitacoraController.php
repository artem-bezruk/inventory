<?php
namespace App\Http\Controllers\Bitacora;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class BitacoraController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index ()
    {
        return view('bitacora.index');
    }
}
