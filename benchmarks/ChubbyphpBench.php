<?php

namespace PhpBench\Benchmarks\Container;

use Chubbyphp\Container\Container;

/**
 * @Groups({"chubbyphp-di"}, extend=true)
 */
class ChubbyphpBench extends ContainerBenchCase
{
    /** @var Container */
    private $container;

    /**
     * @Skip()
     */
    public function benchGetUnoptimized()
    {
    }

    public function benchGetOptimized()
    {
        $this->container->get('bicycle_factory');
    }

    public function benchGetPrototype()
    {
        $this->container->get('bicycle_factory_prototype');
    }

    public function benchLifecycle()
    {
        $this->init();
        $this->container->get('bicycle_factory');
    }

    public function initUnoptimized()
    {
        $this->init();
    }

    public function initOptimized()
    {
        $this->init();
    }

    public function init()
    {
        $container = new Container();

        $container->factory('bicycle_factory', function ($c) {
            return new \PhpBench\Benchmarks\Container\Acme\BicycleFactory;
        });
        $container->prototypeFactory('bicycle_factory_prototype', function ($c) {
            return new \PhpBench\Benchmarks\Container\Acme\BicycleFactory;
        });

        $this->container = $container;
    }
}
