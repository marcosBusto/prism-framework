<?php

namespace Prism\Providers;

use Prism\Crypto\Bcrypt;
use Prism\Crypto\Hasher;

class HasherServiceProvider implements ServiceProvider
{
    public function registerServices()
    {
        match (config("hashing.hasher", "bcrypt")) {
            "bcrypt" => singleton(Hasher::class, Bcrypt::class),
        };
    }
}
