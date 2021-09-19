<?php

namespace Migda\GugikSdk\Objects\Req\Gc\Jpa;

use Migda\GugikSdk\Objects\Req\ReqBaseObject;

class GcReqJpa extends ReqBaseObject
{
    /**
     * odwzorowanie
     *
     * @var int|null
     */
    public ?int $epsg;

    /**
     * lista działek do zgeokodowania
     *
     * @var \Migda\GugikSdk\Objects\Req\Gc\Jpa\GcSingleJpaCollection
     */
    public GcSingleJpaCollection $reqs;
}
