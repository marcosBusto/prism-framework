<?php

namespace Prism\Auth;

use Prism\Auth\Authenticators\Authenticator;

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
}