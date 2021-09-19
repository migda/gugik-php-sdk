<?php

namespace Migda\GugikSdk\Enums;

class HttpMethod
{
    const GET = 'GET';
    const POST = 'POST';

    const ALLOWED_METHODS = [
        self::GET,
        self::POST,
    ];
}
