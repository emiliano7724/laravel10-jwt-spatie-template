<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
        $this->renderable(function (UnauthorizedHttpException $e, $request) {
            return $this->handleAuthenticationException($e, $request);
        });
    }


    protected function handleAuthenticationException(UnauthorizedHttpException $exception, $request)
    {
        if ($request->expectsJson()) {



            $errorMessages = [
                'Token has expired' => 'Token expirado',
                'Token not provided' => 'Token no provisto',
            ];

            $message = $exception->getMessage();

            if (array_key_exists($message, $errorMessages)) {
                return apiwrapper()->unauthorized($errorMessages[$message]);
            }

        }

        return parent::unauthenticated($request, $exception);
    }
}
