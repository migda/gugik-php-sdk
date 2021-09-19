<?php

namespace Migda\GugikSdk\Objects\Res;

use Migda\GugikSdk\Objects\BaseObjectCollection;

class GcResultCollection extends BaseObjectCollection
{
    /**
     * @return GcResult
     */
    public function current(): GcResult
    {
        return parent::current();
    }

    /**
     * @param array $data
     * @return static
     */
    public static function create(array $data): self
    {
        return new static(GcResult::arrayOf($data));
    }
}
