<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    protected $middleware = [
        \App\Http\Middleware\TrustProxies::class,
        \Illuminate\Http\Middleware\SetCacheHeaders::class,
        \Illuminate\Http\Middleware\CheckForMaintenanceMode::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Routing\Middleware\SubstituteBindings::class,
    ];

    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'password.confirm' => \Illuminate\Auth\Middleware\EnsurePasswordIsConfirmed::class,
        'check.permission' => \App\Http\Middleware\CheckPermission::class, // Middleware CheckPermission
        'check.role' => \App\Http\Middleware\CheckRole::class, // Agrega esta línea
    ];

    protected $middlewarePriority = [
        \Illuminate\Auth\Middleware\Authenticate::class,
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\Routing\Middleware\SubstituteBindings::class,
        \Illuminate\Routing\Middleware\CacheResponse::class,
        \App\Http\Middleware\TrimStrings::class,
    ];
}
