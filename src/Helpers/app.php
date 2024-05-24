<?php

use Prism\App;
use Prism\Container\Container;

function app(string $class = App::class)
{
    return Container::resolve($class);
}

function singleton(string $class, string|callable|null $build)
{
    return Container::singleton($class, $build);
}
