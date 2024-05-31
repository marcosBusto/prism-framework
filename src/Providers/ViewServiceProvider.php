<?php

namespace Prism\Providers;

use Prism\View\PrismEngine;
use Prism\View\View;

class ViewServiceProvider implements ServiceProvider
{
    public function registerServices()
    {
        match (config("view.engine", "prism")) {
            "prism" => singleton(View::class, fn () => new PrismEngine(config("view.path"))),
        };
    }
}
