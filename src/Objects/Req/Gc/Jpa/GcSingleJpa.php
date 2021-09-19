<?php

namespace Migda\GugikSdk\Objects\Req\Gc\Jpa;

use Migda\GugikSdk\Objects\Req\ReqBaseObject;

class GcSingleJpa extends ReqBaseObject
{
    /**
     * wyszukiwanie po konkretnym identyfikatorze
     *
     * @var string|null
     */
    public ?string $ftsid;

    /**
     * gmina
     *
     * @var string|null
     */
    public ?string $gm_nazwa;

    /**
     * powiat
     *
     * @var string|null
     */
    public ?string $pow_nazwa;

    /**
     * wyszukiwanie po pełym tekście
     *
     * @var string|null
     */
    public ?string $q;

    /**
     * wartość atrybutu src do zwrócenia w wynikach
     *
     * @var string|null
     */
    public ?string $src;

    /**
     * teryt
     *
     * @var string|null
     */
    public ?string $teryt;

    /**
     * województwo
     *
     * @var string|null
     */
    public ?string $woj_nazwa;
}
