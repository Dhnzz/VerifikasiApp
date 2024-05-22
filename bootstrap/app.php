<?php

use App\Http\Middleware\Role;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\EnsurePostRequest;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->redirectGuestsTo('/');
        $middleware->redirectUsersTo('/dashboard');
        $middleware->alias([
            'postMethod' => EnsurePostRequest::class,
            'roleCheck' => Role::class
        ]);
       
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
