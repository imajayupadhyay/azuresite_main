<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->web(append: [
            \App\Http\Middleware\HandleInertiaRequests::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // Handle 404 errors with Inertia
        $exceptions->render(function (NotFoundHttpException $e, Request $request) {
            return Inertia::render('Error/404')
                ->toResponse($request)
                ->setStatusCode(404);
        });

        // Handle other HTTP errors with Inertia
        $exceptions->render(function (HttpException $e, Request $request) {
            $status = $e->getStatusCode();

            // For 404, use dedicated page
            if ($status === 404) {
                return Inertia::render('Error/404')
                    ->toResponse($request)
                    ->setStatusCode(404);
            }

            // For 500 and server errors, use 500 page
            if ($status >= 500) {
                return Inertia::render('Error/500')
                    ->toResponse($request)
                    ->setStatusCode($status);
            }

            // For other errors, let Laravel handle them
            return null;
        });
    })->create();
