<?php

namespace PhpBench\Benchmarks\Container;

use League\Container\Container;

/**
 * @Groups({"league"}, extend=true)
 */
class LeagueBench extends ContainerBenchCase
{
    /** @var Container */
    private $container;

    public function initOptimized()
    {
        return $this->initUnoptimized();
    }

    public function initUnoptimized()
    {
        $this->container = new Container();

        $this->container->add('bicycle_factory', 'PhpBench\Benchmarks\Container\Acme\BicycleFactory');
        $this->container->share('bicycle_factory_shared', 'PhpBench\Benchmarks\Container\Acme\BicycleFactory');
    }

    /**
     * @Skip()
     */
    public function benchGetUnoptimized()
    {
    }

    public function benchGetOptimized()
    {
        $this->container->get('bicycle_factory_shared');
    }

    public function benchGetPrototype()
    {
        $this->container->get('bicycle_factory');
    }

    public function benchLifecycle()
    {
        $this->initUnoptimized();
        $this->container->get('bicycle_factory_shared');
    }
}
