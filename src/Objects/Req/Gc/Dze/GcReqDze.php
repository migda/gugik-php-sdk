<?php

namespace Migda\GugikSdk\Objects\Req\Gc\Dze;

use Migda\GugikSdk\Objects\Req\ReqBaseObject;

class GcReqDze extends ReqBaseObject
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
     * @var \Migda\GugikSdk\Objects\Req\Gc\Dze\GcSingleDzeCollection
     */
    public GcSingleDzeCollection $reqs;

    /**
     * czy użyć zewnętrznych usug w przypadku nie znalezienia w CAPAP
     *
     * @var bool|null
     */
    public ?bool $useExtServiceIfNotFound;
}
