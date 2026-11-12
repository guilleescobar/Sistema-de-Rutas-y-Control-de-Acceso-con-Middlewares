<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            // Middleware de Autenticación
            'check_auth' => \App\Http\Middleware\CheckAuth::class,
            'CheckAuth'  => \App\Http\Middleware\CheckAuth::class,
            'checkAuth'  => \App\Http\Middleware\CheckAuth::class,
            'check.auth' => \App\Http\Middleware\CheckAuth::class,

            // Middleware de Administrador
            'check_admin' => \App\Http\Middleware\CheckAdmin::class,
            'CheckAdmin'  => \App\Http\Middleware\CheckAdmin::class,
            'checkAdmin'  => \App\Http\Middleware\CheckAdmin::class,
            'check.admin' => \App\Http\Middleware\CheckAdmin::class,
            'admin'       => \App\Http\Middleware\CheckAdmin::class,

            // Middleware de Edad
            'check_age' => \App\Http\Middleware\CheckAge::class,
            'CheckAge'  => \App\Http\Middleware\CheckAge::class,
            'checkAge'  => \App\Http\Middleware\CheckAge::class,
            'check.age' => \App\Http\Middleware\CheckAge::class,
            'age'       => \App\Http\Middleware\CheckAge::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->shouldRenderJsonWhen(
            fn (Request $request) => $request->is('api/*') || $request->expectsJson(),
        );
    })->create();
