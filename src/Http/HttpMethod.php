<?php

namespace Prism\Http;

/**
 * HTTP verb.
 */
enum HttpMethod: string {
    case GET = "GET";
    case POST = "POST";
    case PUT = "PUT";
    case PATCH = "PATCH";
    case DELETE = "DELETE";
}