<?php

namespace Prism\Server;

use Prism\Http\Request;
use Prism\Http\Response;

/**
 * Similar to PHP `$_SERVER` but having an interface allows us to mock these
 * global variables, useful for testing.
 */
interface Server
{
    /**
     * Get request sent by the client.
     *
     * @return Request
     */
    public function getRequest(): Request;

    /**
     * Send the response to the client.
     *
     * @param Response $response
     * @return void
     */
    public function sendResponse(Response $response);
}
