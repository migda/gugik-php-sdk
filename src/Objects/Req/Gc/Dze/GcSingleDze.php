<?php

namespace Migda\GugikSdk\Objects\Req\Gc\Dze;

use Migda\GugikSdk\Objects\Req\ReqBaseObject;

class GcSingleDze extends ReqBaseObject
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
     * wartość atrybutu id do zwrócenia w wynikach
     *
     * @var int|null
     */
    public ?int $id;

    /**
     * pełny identyfikator SWDE
     *
     * @var string|null
     */
    public ?string $idswde;

    /**
     * miejscowość
     *
     * @var string|null
     */
    public ?string $miejsc_nazwa;

    /**
     * numer działki
     *
     * @var string|null
     */
    public ?string $nr_dz;

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
