<?php



namespace App\Exceptions;

use Throwable;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
    // public function report(Throwable $exception)
    // {
    // }
    // public function shouldReport(Throwable $exception)
    // {
    // }
    // public function render($request, Throwable $exception)
    // {
    // }
    // public function renderForConsole($output, Throwable $exception)
    // {
    // }
}
