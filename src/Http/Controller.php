<?php

namespace Prism\Http;

class Controller
{
    /**
     * HTTP middlewares.
     *
     * @var \Prism\Http\Middleware[]
     */
    protected array $middlewares = [];

    /**
     * Get all HTTP middlewares for this route.
     *
     * @return \Prism\Http\Middleware[]
     */
    public function middlewares(): array
    {
        return $this->middlewares;
    }

    public function setMiddlewares(array $middlewares): self
    {
        $this->middlewares = array_map(fn ($middleware) => new $middleware(), $middlewares);

        return $this;
    }
}
