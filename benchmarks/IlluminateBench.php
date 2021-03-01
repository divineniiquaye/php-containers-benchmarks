<?php

namespace PhpBench\Benchmarks\Container;

use Illuminate\Container\Container;

/**
 * @Groups({"illuminate"}, extend=true)
 */
class IlluminateBench extends ContainerBenchCase
{
    /** @var Container */
    private $container;

    /**
     * @BeforeMethods({"init"})
     */
    public function benchGetOptimized()
    {
        $this->container->get('bicycle_factory_shared');
    }

    public function benchGetUnoptimized()
    {
        $this->container['bicycle_factory_shared'];
    }

    public function benchGetPrototype()
    {
        $this->container['bicycle_factory'];
    }

    public function benchLifecycle()
    {
        $this->init();
        $this->container['bicycle_factory_shared'];
    }

    public function initOptimized()
    {
        $this->init();
    }

    public function initUnoptimized()
    {
        $this->init();
    }

    public function init()
    {
        $builder = new Container();
        $builder->bind('bicycle_factory_shared', function ($app) {
            return new \PhpBench\Benchmarks\Container\Acme\BicycleFactory();
        }, true);
        $builder->bind('bicycle_factory', function ($app) {
            return new \PhpBench\Benchmarks\Container\Acme\BicycleFactory();
        });
        $this->container = $builder;
    }
}
