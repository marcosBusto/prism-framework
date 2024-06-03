<?php

return [
    /**
     * Service providers that will run before booting application
     */
    'boot' => [
        /**
         * Prism framework service providers
         */
        Prism\Providers\ServerServiceProvider::class,
        Prism\Providers\DatabaseDriverServiceProvider::class,
        Prism\Providers\SessionStorageServiceProvider::class,
        Prism\Providers\ViewServiceProvider::class,
        Prism\Providers\AuthenticatorServiceProvider::class,
        Prism\Providers\HasherServiceProvider::class,
        Prism\Providers\FileStorageDriverServiceProvider::class,

        /**
         * Package service providers
         */
    ],

    /**
     * Service providers that will run after booting application
     */
    'runtime' => [
        App\Providers\RuleServiceProvider::class,
        App\Providers\RouteServiceProvider::class,
        App\Providers\AppServiceProvider::class
    ],

    'cli' => [
        Prism\Providers\DatabaseDriverServiceProvider::class,
    ]
];