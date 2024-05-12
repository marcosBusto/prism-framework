<?php

namespace Prism\Tests\Http;

use Prism\Http\HttpMethod;
use Prism\Http\Request;
use Prism\Server\Server;
use PHPUnit\Framework\TestCase;

class RequestTest extends TestCase
{
    public function test_request_returns_data_obtained_from_server_correctly()
    {
        $uri = '/test/route';
        $queryParams = ['a' => 1, 'b' => 2, 'test' => 'foo'];
        $postData = ['post' => 'test', 'foo' => 'bar'];

        $request = (new Request())
            ->setUri($uri)
            ->setMethod(HttpMethod::POST)
            ->setQueryParameters($queryParams)
            ->setPostData($postData);

        $this->assertEquals($uri, $request->uri());
        $this->assertEquals($queryParams, $request->query());
        $this->assertEquals($postData, $request->data());
        $this->assertEquals(HttpMethod::POST, $request->method());
    }
}
