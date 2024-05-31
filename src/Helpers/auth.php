<?php

use Prism\Auth\Auth;
use Prism\Auth\Authenticatable;

function auth(): ?Authenticatable
{
    return Auth::user();
}

function isGuest(): bool
{
    return Auth::isGuest();
}
