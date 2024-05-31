<?php

namespace Prism\Providers;

use Prism\Auth\Authenticators\Authenticator;
use Prism\Auth\Authenticators\SessionAuthenticator;

class AuthenticatorServiceProvider implements ServiceProvider
{
    public function registerServices()
    {
        match (config("auth.method", "session")) {
            "session" => singleton(Authenticator::class, SessionAuthenticator::class),
        };
    }
}
