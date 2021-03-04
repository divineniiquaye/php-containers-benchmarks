<?php

namespace PhpBench\Benchmarks\Container;

use Rade\DI\Container;

/**
 * @Groups({"rade-di"}, extend=true)
 */
class RadeDiBench extends ContainerBenchCase
{
    /** @var Container */
    private $container;

    public function benchGetUnoptimized()
    {
        $this->container['bicycle_factory_shared'];
    }

    public function benchGetOptimized()
    {
        $this->container['bicycle_factory_shared'];
    }

    public function benchGetPrototype()
    {
        $this->container['bicycle_factory'];
    }

    public function benchLifecycle()
    {
        $this->initOptimized();
        $this->container['bicycle_factory_shared'];
    }

    public function initUnoptimized()
    {
        $this->container = self::getContainer();
    }

    public function initOptimized()
    {
        $this->container = new OptimizedRadeContainer();
    }

    public function initPrototype()
    {
        $this->initOptimized();
    }

    public static function getContainer()
    {
        $container = new Container();
        $container->set('bicycle_factory_shared', new \PhpBench\Benchmarks\Container\Acme\BicycleFactory());
        $container->set('bicycle_factory', $container->factory(function () {
            return new \PhpBench\Benchmarks\Container\Acme\BicycleFactory();
        }));

        return $container;
    }
}

class OptimizedRadeContainer extends Container {
    protected const METHODS_MAP = [
        'container' => 'getServiceContainer',
        'bicycle_factory_shared' => 'getBicycleFactoryShared',
        'bicycle_factory' => 'getBicycleFactory',
    ];

    protected function getBicycleFactoryShared()
    {
        return new \PhpBench\Benchmarks\Container\Acme\BicycleFactory();
    }

    protected function getBicycleFactory()
    {
        $bicycle = function () {
            return new \PhpBench\Benchmarks\Container\Acme\BicycleFactory();
        };

        return $bicycle();
    }
}
