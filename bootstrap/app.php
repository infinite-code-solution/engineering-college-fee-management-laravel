<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Global handler for API requests rendering non-200 statuses
        $exceptions->render(function (Throwable $e, Request $request) {
            if ($request->is('api/*')) {
                $statusCode = $e instanceof HttpExceptionInterface ? $e->getStatusCode() : 500;
                
                // If it's a validation exception, you might want to fetch its default message
                $message = $e->getMessage() ?: 'An unexpected error occurred.';

                return response()->json([
                    'status' => $statusCode,
                    'message' => $message,
                ], $statusCode);
            }
        });
    })->create();
