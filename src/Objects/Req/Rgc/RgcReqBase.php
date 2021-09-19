<?php

namespace Migda\GugikSdk\Objects\Req\Rgc;

use Migda\GugikSdk\Objects\Req\ReqBaseObject;

class RgcReqBase extends ReqBaseObject
{
    /**
     * odległość [metry]
     *
     * @var float
     */
    public float $d;

    /**
     * x (lon)
     *
     * @var float
     */
    public float $x;

    /**
     * y (lat)
     *
     * @var float
     */
    public float $y;
}
