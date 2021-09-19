<?php

namespace Migda\GugikSdk\Enums;

class HttpMethod
{
    public const GET = 'GET';
    public const POST = 'POST';

    public const ALLOWED_METHODS = [
        self::GET,
        self::POST,
    ];
}
