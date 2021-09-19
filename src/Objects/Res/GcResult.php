<?php

namespace Migda\GugikSdk\Objects\Res;

use Migda\GugikSdk\Objects\BaseObject;

class GcResult extends BaseObject
{
    /**
     * dla odwrotnego geokodowania - odległość
     *
     * @var float|null
     */
    public ?float $distance;

    /**
     * czas wywołania usług zewnętrznych w ms
     *
     * @var int|null
     */
    public ?int $extTimeMs;

    /**
     * wartość atrybutu id przekazana w wywołaniu zapytania
     *
     * @var int|null
     */
    public ?int $id;

    /**
     * pozostałe, mniej trafne wyniki - jeśli są
     *
     * @var array[]|null
     */
    public ?array $others;

    /**
     * trafność wyniku, liczona dla najlepszego trafienia
     *
     * @var float|null
     */
    public ?float $relevance;

    /**
     * dla geokodowania - punktacja wyszukiwania
     *
     * @var float|null
     */
    public ?float $score;

    /**
     * najlepsze trafienie będące wynikiem zapytania
     *
     * @var array|null
     */
    public ?array $single;

    /**
     * najlepsze trafienie będące wynikiem zapytania
     *
     * @var string|null
     */
    public ?string $source;

    /**
     * wartość atrybutu src przekazana w wywołaniu zapytania
     *
     * @var string|null
     */
    public ?string $src;

    /**
     * @var string|null
     */
    public ?string $xmessage;
}
