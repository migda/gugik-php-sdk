<?php

namespace Migda\GugikSdk\HttpClients;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\RequestOptions;
use Psr\Http\Client\RequestExceptionInterface;
use Psr\Http\Message\ResponseInterface;

class GuzzleHttpClient implements HttpClientInterface
{
    /**
     * @var GuzzleClient
     */
    protected $client;

    /**
     * @var int
     */
    protected $timeOut = 30;

    /**
     * GuzzleHttpClient constructor.
     */
    public function __construct(ClientInterface $client = null)
    {
        $this->client = $client ?? new GuzzleClient();
    }

    /**
     * @param string $url
     * @param string $method
     * @param array $headers
     * @param array $options
     * @return mixed|ResponseInterface|null
     */
    public function send(string $url, string $method, array $headers = [], array $options = [])
    {
        $json = $options['json'] ?? null;

        $options = $this->getOptions($headers, $json, $options);

        try {
            $response = $this->getClient()->{$method}($url, $options);
        } catch (GuzzleException $e) {
            $response = null;
            if ($e instanceof RequestExceptionInterface || $e instanceof RequestException) {
                $response = $e->getResponse();
            }
        }

        return $response;
    }

    /**
     * @return int
     */
    public function getTimeOut(): int
    {
        return $this->timeOut;
    }

    /**
     * @param $timeOut
     * @return $this
     */
    public function setTimeOut($timeOut): self
    {
        $this->timeOut = $timeOut;

        return $this;
    }

    /**
     * Prepares and returns request options.
     *
     * @param array $headers
     * @param array|null $json
     * @param array $options
     *
     * @return array
     */
    private function getOptions(array $headers, array $json = null, array $options = []): array
    {
        $defaults = [
            RequestOptions::HEADERS => $headers,
            RequestOptions::JSON => $json,
            RequestOptions::TIMEOUT => $this->getTimeOut(),
        ];

        return array_merge($defaults, $options);
    }

    /**
     * @return GuzzleClient
     */
    private function getClient(): GuzzleClient
    {
        return $this->client;
    }
}
