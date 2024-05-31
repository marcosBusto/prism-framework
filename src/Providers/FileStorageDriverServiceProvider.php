<?php

namespace Prism\Providers;

use Prism\App;
use Prism\Storage\Drivers\DiskFileStorage;
use Prism\Storage\Drivers\FileStorageDriver;

class FileStorageDriverServiceProvider
{
    public function registerServices()
    {
        match (config("storage.driver", "disk")) {
            "disk" => singleton(
                FileStorageDriver::class,
                fn () => new DiskFileStorage(
                    App::$root . "/storage",
                    "storage",
                    config("app.url")
                )
            ),
        };
    }
}
