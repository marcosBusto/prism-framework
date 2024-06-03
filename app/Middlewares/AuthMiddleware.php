<?php

namespace App\Middlewares;

use Closure;
use Prism\Auth\Auth;
use Prism\Http\Middleware;
use Prism\Http\Request;
use Prism\Http\Response;

class AuthMiddleware implements Middleware {
    public function handle(Request $request, Closure $next): Response {
        if (Auth::isGuest()) {
            return redirect('/login');
        }

        return $next($request);
    }
}