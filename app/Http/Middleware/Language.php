<?php
namespace App\Http\Middleware;
use Closure;
use App;
class Language
{
    public function handle($request, Closure $next)
    {
        $languages = [ "en", "es" ];
        $lang = $request->segment(1);
        if (!in_array($lang, $languages)) {
            abort(404);
        }
        App::setLocale($lang);
        return $next($request);
    }
}
