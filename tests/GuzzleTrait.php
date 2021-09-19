<?php

namespace Migda\GugikSdk\Tests;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Migda\GugikSdk\HttpClients\GuzzleHttpClient;

/**
 * https://docs.guzzlephp.org/en/stable/testing.html#mock-handler
 */
trait GuzzleTrait
{
    /**
     * @param array $responses
     *
     * @return GuzzleHttpClient
     */
    protected function getGuzzleHttpClient(array $responses = [])
    {
        return new GuzzleHttpClient($this->createClientWithResponses($responses));
    }

    /**
     * @param array $responses
     *
     * @return GuzzleClient
     */
    protected function createClientWithResponses(array $responses): GuzzleClient
    {
        $mock = new MockHandler($responses);
        $handlerStack = HandlerStack::create($mock);

        return new GuzzleClient(['handler' => $handlerStack]);
    }

    /**
     * @param int $code
     * @param array $headers
     * @param array $body
     * @return Response
     */
    protected function makeFakeResponse(int $code, array $headers, array $body): Response
    {
        return new Response($code, $headers, json_encode($body));
    }
}
