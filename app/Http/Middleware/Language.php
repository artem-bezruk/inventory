<?php
namespace App\Http\Middleware;
use Closure;
use Session;
use App;
use Config;
class Language
{
    public function handle($request, Closure $next)
    {
        if (Session::has("lang")) {
            $lang = Session::get("lang");
        } else {
            $lang = "es";
        }
        App::setLocale($lang);
        return $next($request);
    }
}
