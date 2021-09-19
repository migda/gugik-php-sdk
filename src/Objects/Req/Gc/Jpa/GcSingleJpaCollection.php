<?php

namespace Migda\GugikSdk\Objects\Req\Gc\Jpa;

use Migda\GugikSdk\Objects\BaseObjectCollection;

class GcSingleJpaCollection extends BaseObjectCollection
{
    /**
     * @return \Migda\GugikSdk\Objects\Req\Gc\Jpa\GcSingleJpa
     */
    public function current(): GcSingleJpa
    {
        return parent::current();
    }
}
