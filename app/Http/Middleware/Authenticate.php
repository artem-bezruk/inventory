<?php
namespace App\Http\Middleware;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
class Authenticate extends Middleware
{
    protected function authenticate($request, array $guards)
    {
        if (auth()->user()->eliminado != true) {
            if (empty($guards)) {
                $guards = [null];
            }
            foreach ($guards as $guard) {
                if ($this->auth->guard($guard)->check()) {
                    return $this->auth->shouldUse($guard);
                }
            }
        }
        else {
            $this->auth->guard()->logout();
            $request->session()->invalidate();
        }
        $this->unauthenticated($request, $guards);
    }
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            $lang = $request->segment(1);
            return route('login', ['locale' => $lang]);
        }
    }
}
