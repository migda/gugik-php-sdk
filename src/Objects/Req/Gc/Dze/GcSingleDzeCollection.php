<?php

namespace Migda\GugikSdk\Objects\Req\Gc\Dze;

use Migda\GugikSdk\Objects\BaseObjectCollection;

class GcSingleDzeCollection extends BaseObjectCollection
{
    /**
     * @return \Migda\GugikSdk\Objects\Req\Gc\Dze\GcSingleDze
     */
    public function current(): GcSingleDze
    {
        return parent::current();
    }
}
