<?php

namespace DineroSDK\Resource;

use DineroSDK\Dinero;

abstract class AbstractResource
{
    /** @var Dinero */
    protected $dinero;

    /**
     * AbstractResource constructor.
     * @param Dinero $dinero
     */
    public function __construct(Dinero $dinero)
    {
        $this->dinero = $dinero;
    }
}
