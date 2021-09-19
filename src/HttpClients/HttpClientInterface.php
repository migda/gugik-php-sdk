<?php

namespace Migda\GugikSdk\HttpClients;

interface HttpClientInterface
{
    /**
     * @param string $url
     * @param string $method
     * @param array $headers
     * @param array $options
     *
     * @return mixed
     */
    public function send(string $url, string $method, array $headers = [], array $options = []);

    /**
     * @return int
     */
    public function getTimeOut(): int;

    /**
     * @param int $timeOut
     *
     * @return $this
     */
    public function setTimeOut($timeOut): self;
}
