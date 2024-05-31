<?php

namespace App\Providers;

use Prism\App;
use Prism\Providers\ServiceProvider;
use Prism\Routing\Route;

class RouteServiceProvider implements ServiceProvider {
    public function registerServices() {
        Route::load(App::$root . "/routes");
    }
}