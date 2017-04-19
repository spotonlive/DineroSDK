<?php

namespace DineroSDK\Resource;

use DineroSDK\Dinero;
use GeneratedHydrator\Configuration;

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

    /**
     * Generate a new hydrator
     *
     * @param $class
     * @return mixed
     */
    protected function createHydrator($class)
    {
        $config = new Configuration($class);
        $hydratorClass = $config->createFactory()->getHydratorClass();

        return new $hydratorClass;
    }
}
