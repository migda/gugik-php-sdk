<?php

namespace Migda\GugikSdk;

use Migda\GugikSdk\Enums\HttpMethod;
use Migda\GugikSdk\Exceptions\GugikException;

class GugikRequest
{
    protected string $method;
    protected string $endpoint;
    protected array $headers = [];
    protected array $params = [];
    protected int $timeOut;

    /**
     * Creates a new Request entity.
     *
     * @param string|null $method
     * @param string|null $endpoint
     * @param array $params
     * @throws GugikException
     */
    public function __construct(string $method = null, string $endpoint = null, array $params = [])
    {
        $this->setMethod($method);
        $this->setEndpoint($endpoint);
        $this->setParams($params);
    }

    /**
     * @throws GugikException
     */
    public function validateMethod(): void
    {
        if (! $this->method) {
            throw new GugikException('HTTP method was not specified.');
        }

        if (! in_array($this->method, HttpMethod::ALLOWED_METHODS)) {
            throw new GugikException('Specified HTTP method is invalid. Use: '
                . implode(', ', HttpMethod::ALLOWED_METHODS));
        }
    }

    /**
     * @return string
     */
    public function getEndpoint(): string
    {
        return $this->endpoint;
    }

    /**
     * @param string $endpoint
     *
     * @return GugikRequest
     */
    public function setEndpoint(string $endpoint): self
    {
        $this->endpoint = trim($endpoint, '/');

        return $this;
    }

    /**
     * @return array
     */
    public function getHeaders(): array
    {
        $headers = $this->getDefaultHeaders();

        return array_merge($this->headers, $headers);
    }

    /**
     * @param array $headers
     *
     * @return GugikRequest
     */
    public function setHeaders(array $headers): self
    {
        $this->headers = array_merge($this->headers, $headers);

        return $this;
    }

    /**
     * @return string[]
     */
    public function getDefaultHeaders(): array
    {
        return [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ];
    }

    /**
     * @return array
     */
    public function getPostParams(): array
    {
        if ($this->getMethod() === 'POST') {
            return $this->getParams();
        }

        return [];
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @param string $method
     *
     * @return GugikRequest
     * @throws GugikException
     */
    public function setMethod(string $method): self
    {
        $this->method = strtoupper($method);
        $this->validateMethod();

        return $this;
    }

    /**
     * @return array
     */
    public function getParams(): array
    {
        return $this->params;
    }

    /**
     * @param array $params
     *
     * @return GugikRequest
     */
    public function setParams(array $params = []): self
    {
        $this->params = array_merge($this->params, $params);

        return $this;
    }

    /**
     * @return int
     */
    public function getTimeOut(): int
    {
        return $this->timeOut;
    }

    /**
     * @param int $timeOut
     *
     * @return GugikRequest
     */
    public function setTimeOut(int $timeOut): self
    {
        $this->timeOut = $timeOut;

        return $this;
    }
}
