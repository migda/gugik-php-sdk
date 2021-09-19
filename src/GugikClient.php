<?php

namespace Migda\GugikSdk;

use Migda\GugikSdk\HttpClients\GuzzleHttpClient;
use Migda\GugikSdk\Enums\HttpMethod;
use Migda\GugikSdk\HttpClients\HttpClientInterface;

class GugikClient
{
    const BASE_URL = 'http://capap.gugik.gov.pl/api/fts/';

    /**
     * Http client
     *
     * @var HttpClientInterface
     */
    protected HttpClientInterface $httpClient;

    /**
     * GugikSdk constructor.
     * @param HttpClientInterface|null $httpClient
     */
    public function __construct(HttpClientInterface $httpClient = null)
    {
        $this->httpClient = $httpClient ?? new GuzzleHttpClient();
    }

    /**
     * Returns the HTTP client handler.
     *
     * @return HttpClientInterface
     */
    public function getHttpClient(): HttpClientInterface
    {
        return $this->httpClient;
    }

    /**
     * @param HttpClientInterface $httpClient
     * @return $this
     */
    public function setHttpClient(HttpClientInterface $httpClient): self
    {
        $this->httpClient = $httpClient;

        return $this;
    }

    /**
     * @param GugikRequest $request
     * @return GugikResponse
     * @throws Exceptions\GugikResponseException
     */
    public function sendRequest(GugikRequest $request): GugikResponse
    {
        $url = $this->getBaseUrl() . $request->getEndpoint();
        $method = $request->getMethod();
        $headers = $request->getHeaders();
        $options = $this->getOption($request, $method);

        $rawResponse = $this->getHttpClient()
            ->setTimeOut($request->getTimeOut())
            ->send($url, $method, $headers, $options);

        return new GugikResponse($rawResponse);
    }

    /**
     * @return string
     */
    public function getBaseUrl(): string
    {
        return static::BASE_URL;
    }

    /**
     * @param GugikRequest $request
     * @param $method
     * @return array
     */
    private function getOption(GugikRequest $request, $method)
    {
        if ($method === HttpMethod::POST) {
            return $request->getPostParams();
        }

        return ['query' => $request->getParams()];
    }
}
