<?php
namespace App\Exceptions;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
class Handler extends ExceptionHandler
{
    protected $dontReport = [
    ];
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }
    public function render($request, Throwable $exception)
    {
        $languages = [ "en", "es" ];
        $lang = $request->segment(1);
        if (!in_array($lang, $languages)) {
            $lang = app()->getLocale();
        }
        app()->setLocale($lang);
        return parent::render($request, $exception);
    }
}
