<?php

namespace PhpBench\Benchmarks\Container;

use PhpBench\Benchmarks\Container\Acme\BicycleFactory;
use Laminas\ServiceManager\ServiceManager;

/**
 * @Groups({"phpbench"}, extend=true)
 */
class LaminasServiceManagerBench extends ContainerBenchCase
{
    /** @var ServiceManager */
    private $container;

    public function initOptimized()
    {
        $this->container = new ServiceManager([
            'factories' => [
                'bicycle_factory' => function () {
                    return new BicycleFactory();
                },
                'bicycle_factory_prototype' => function () {
                    return new BicycleFactory();
                },
            ],
            'shared' => [
                'bicycle_factory_prototype' => false,
            ]
        ]);
    }

    public function initUnoptimized()
    {
        $container = new ServiceManager();
        $container->setFactory('bicycle_factory', function () {
            return new BicycleFactory();
        });
        $container->setFactory('bicycle_factory_prototype', function () {
            return new BicycleFactory();
        });
        $container->setShared('bicycle_factory_prototype', false);

        $this->container = $container;
    }

    public function benchLifecycle()
    {
        $this->initUnoptimized();
        $this->container->get('bicycle_factory');
    }

    public function benchGetOptimized()
    {
        $this->container->get('bicycle_factory');
    }

    public function benchGetUnoptimized()
    {
        $this->container->get('bicycle_factory');
    }

    public function benchGetPrototype()
    {
        $this->container->get('bicycle_factory_prototype');
    }
}
