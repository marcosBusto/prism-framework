<?php

namespace Prism\Providers;

use Prism\Session\PhpNativeSessionStorage;
use Prism\Session\SessionStorage;

class SessionStorageServiceProvider implements ServiceProvider
{
    public function registerServices()
    {
        match (config("session.storage", "native")) {
            "native" => singleton(SessionStorage::class, PhpNativeSessionStorage::class),
        };
    }
}
