<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
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
    }

    public function render($request, Throwable $e)
    {
        if ($e instanceof AuthenticationException) {
            if ($request->is('api/*')) {
                return $this->unauthorized($e);
            }
        }

        if ($e instanceof AuthorizationException) {
            return $this->forbidden($e);
        }

        if ($e instanceof ValidationException) {
            if ($request->is('api/*')) {
                return $this->badRequest($e);
            }
        }

        return parent::render($request, $e);
    }

    protected function badRequest(ValidationException $e) 
    {
        return response()
            ->json([
                'message' => 'Invalid request!',
                'data' => $e->errors() 
            ], 400);
    }

    protected function forbidden(AuthorizationException $e) 
    {
        return response()
            ->json([
                'message' => 'No permission to perform this action!',
            ], 403);
    }

    protected function unauthorized(AuthenticationException $e) 
    {
        return response()
            ->json([
                'message' => 'Not logged in!'
            ], 401);
    }
}
