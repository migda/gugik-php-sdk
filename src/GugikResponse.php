<?php

namespace Migda\GugikSdk;

use Migda\GugikSdk\Exceptions\GugikResponseException;

class GugikResponse
{
    protected $statusCode;
    protected $headers;
    protected $body;
    protected $decodedBody = [];

    /**
     * GugikResponse constructor.
     * @param $response
     * @throws GugikResponseException
     */
    public function __construct($response)
    {
        $this->statusCode = $response->getStatusCode();
        $this->headers = $response->getHeaders();

        $this->body = $response->getBody();
        $this->decodedBody = json_decode($this->body, true);

        if ($this->hasError()) {
            throw new GugikResponseException($this);
        }
    }

    /**
     * @return bool
     */
    public function hasError(): bool
    {
        return isset($this->decodedBody['error']);
    }

    /**
     * @return mixed
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * @return array
     */
    public function getDecodedBody(): array
    {
        return $this->decodedBody;
    }

    /**
     * @return mixed
     */
    public function getResult()
    {
        return $this->decodedBody['result'];
    }
}
