<?php

namespace Prism\Http;

use Closure;

interface Middleware
{
    public function handle(Request $request, Closure $next): Response;
}
