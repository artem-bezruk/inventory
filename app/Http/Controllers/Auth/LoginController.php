<?php
namespace App\Http\Controllers\Auth;
use App\Bitacora;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
class LoginController extends Controller
{
    use AuthenticatesUsers;
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function showLoginForm()
    {
        return view('login.index');
    }
    public function redirectTo()
    {
        $bitacora = new Bitacora();
        $accion = \App\Accion::where('accion', 'Login')->first();
        $descripcion = "Logged in";
        $bitacora->registro(null, null, $accion->id, \Request::ip(), $descripcion);
        return route('dashboard', ['locale' => app()->getLocale()]);
    }
    public function login(Request $request)
    {
        $this->validateLogin($request);
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }
        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }
        $this->incrementLoginAttempts($request);
        return $this->sendFailedLoginResponse($request);
    }
    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
        ]);
    }
    protected function attemptLogin(Request $request)
    {
        return $this->guard()->attempt(
            $this->credentials($request), $request->filled('remember')
        );
    }
    protected function credentials(Request $request)
    {
        $credentials = $request->only('username', 'password');
        $credentials['estatus_id'] = 1;
        $credentials['eliminado'] = 0;
        return $credentials;
    }
    public function username()
    {
        return 'username';
    }
    public function logout (Request $request)
    {
        $bitacora = new Bitacora();
        $accion = \App\Accion::where('accion', 'Logout')->first();
        $descripcion = "Logged out";
        $bitacora->registro(null, null, $accion->id, \Request::ip(), $descripcion);
        $this->guard()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect(route('home', ['locale' => app()->getLocale()]));
    }
}
