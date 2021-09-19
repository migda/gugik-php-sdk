<?php

namespace Migda\GugikSdk\Tests;

use Migda\GugikSdk\Exceptions\GugikResponseException;
use Migda\GugikSdk\Gugik;
use Migda\GugikSdk\HttpClients\GuzzleHttpClient;
use PHPUnit\Framework\TestCase;


class GugikTest extends TestCase
{
    use GuzzleTrait;

    /** @test */
    public function it_set_guzzle_http_client_if_no_http_client_is_specified_when_initialized_gugik_object()
    {
        // Arrange
        $gugik = new Gugik();

        // Act
        $client = $gugik->getClient()->getHttpClient();

        // Assert
        $this->assertInstanceOf(GuzzleHttpClient::class, $client);
    }

    /** @test */
    public function it_throws_an_exception_if_found_error_property_in_response()
    {
        // Arrange
        $badUpdateReply = $this->makeFakeResponse(400, ['X-Foo' => 'Bar'], ['error' => 'Error :).']);
        $gugik = new Gugik($this->getGuzzleHttpClient([$badUpdateReply]));

        // Act and assert
        $this->expectException(GugikResponseException::class);
        $gugik->test();
    }

    /** @test */
    public function it_not_throws_an_exception_if_not_found_error_property_in_response()
    {
        // Arrange
        $badUpdateReply = $this->makeFakeResponse(200, ['X-Foo' => 'Bar'], ['success' => 'Success :).']);
        $gugik = new Gugik($this->getGuzzleHttpClient([$badUpdateReply]));

        // Act
        $gugik->test();

        // Assert true => no exception has been thrown
        $this->assertTrue(true);
    }
}
