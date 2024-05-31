<?php

namespace Prism\Auth;

use App\Controllers\Auth\LoginController;
use App\Controllers\Auth\RegisterController;
use Prism\Auth\Authenticators\Authenticator;
use Prism\Routing\Route;

class Auth
{
    public static function user(): ?Authenticatable
    {
        return app(Authenticator::class)->resolve();
    }
    public static function isGuest(): bool
    {
        return is_null(self::user());
    }

    public static function routes()
    {
        Route::get('/register', [RegisterController::class, 'create']);
        Route::post('/register', [RegisterController::class, 'store']);
        Route::get('/login', [LoginController::class, 'create']);
        Route::post('/login', [LoginController::class, 'store']);
        Route::get('/logout', [LoginController::class, 'destroy']);
    }
}
