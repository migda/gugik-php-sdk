<?php

namespace Migda\GugikSdk\Exceptions;

use Migda\GugikSdk\GugikResponse;

class GugikResponseException extends GugikException
{
    /**
     * GugikResponseException constructor.
     * @param GugikResponse $response
     */
    public function __construct(GugikResponse $response)
    {
        parent::__construct($response->getBody(), $response->getStatusCode());
    }
}
