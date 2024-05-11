<?php

namespace Prism\Server;

use Prism\Http\HttpMethod;
use Prism\Http\Response;

interface Server {
    public function requestUri(): string;
    public function requestMethod(): HttpMethod;
    public function postData(): array;
    public function queryParams(): array;
    public function sendResponse(Response $response);
}