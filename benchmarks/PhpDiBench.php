<?php

namespace PhpBench\Benchmarks\Container;

use DI\ContainerBuilder;
use DI\Container;

/**
 * @Groups({"php-di"}, extend=true)
 */
class PhpDiBench extends ContainerBenchCase
{
    /** @var Container */
    private $container;

    private function createOptimizedBuilder()
    {
        $builder = new ContainerBuilder();
        $builder->addDefinitions([
            'bicycle_factory_shared' => \DI\create('PhpBench\Benchmarks\Container\Acme\BicycleFactory'),
            'bicycle_factory' => \Di\factory(function () {
                return new \PhpBench\Benchmarks\Container\Acme\BicycleFactory();
            })
        ]);

        return $builder;
    }

    public function initOptimized()
    {
        $builder = $this->createOptimizedBuilder();
        $builder->enableCompilation(self::getCacheDir());

        $this->container = $builder->build();
    }

    public function initUnoptimized()
    {
        $this->container = $this->createOptimizedBuilder()->build();
    }

    public function initPrototype()
    {
        $this->initOptimized();
    }

    public function benchGetOptimized()
    {
        $this->container->get('bicycle_factory_shared');
    }

    public function benchGetUnoptimized()
    {
        $this->container->get('bicycle_factory_shared');
    }

    public function benchGetPrototype()
    {
        $this->container->make('bicycle_factory');
    }

    public function benchLifecycle()
    {
        $this->initOptimized();
        $this->container->get('bicycle_factory_shared');
    }
}
