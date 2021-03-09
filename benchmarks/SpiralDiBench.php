<?php

namespace PhpBench\Benchmarks\Container;

use Spiral\Core\Container;

/**
 * @Groups({"spiral-di"}, extend=true)
 */
class SpiralDiBench extends ContainerBenchCase
{
    /** @var Container */
    private $container;

    public function benchGetUnoptimized()
    {
        $this->container->get('bicycle_factory');
    }

    public function benchGetOptimized()
    {
        $this->container->make('bicycle_factory');
    }

    public function benchGetPrototype()
    {
        $this->container->make('bicycle_factory');
    }

    public function benchLifecycle()
    {
        $this->initOptimized();
        $this->container->make('bicycle_factory_shared');
    }

    public function initUnoptimized()
    {
        $container = new Container();
        $container->bind('bicycle_factory', new \PhpBench\Benchmarks\Container\Acme\BicycleFactory());

        $this->container = $container;
    }

    public function initOptimized()
    {
        $this->initUnoptimized();
    }
}
