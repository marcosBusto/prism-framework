<?php

return [
    'boot' => [
        Prism\Providers\ServerServiceProvider::class,
        Prism\Providers\DatabaseDriverServiceProvider::class,
        Prism\Providers\SessionStorageServiceProvider::class,
        Prism\Providers\ViewServiceProvider::class,
    ],

    'runtime' => [

    ]
];