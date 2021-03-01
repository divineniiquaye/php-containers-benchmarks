<?php

namespace PhpBench\Benchmarks\Container;

use Nette\DI\Compiler;
use Nette\DI\Container;
use Nette\DI\ContainerLoader;

/**
 * @Groups({"nette-di"}, extend=true)
 */
class NetteDiBench extends ContainerBenchCase
{
    /** @var Container */
    private $container;

    public static function getContainer()
    {
        $builder = new Container();
        $builder->addService('bicycle_factory', function () {
            return new \PhpBench\Benchmarks\Container\Acme\BicycleFactory();
        });
        $builder->addService('bicycle_factory_shared', new \PhpBench\Benchmarks\Container\Acme\BicycleFactory());

        return $builder;
    }

    public function benchGetOptimized()
    {
        $this->container->getService('bicycle_factory_shared');
    }

    public function benchGetUnoptimized()
    {
        $this->container->getByName('bicycle_factory');
    }

    public function benchGetPrototype()
    {
        $this->container->getByType('PhpBench\Benchmarks\Container\Acme\BicycleFactory');
    }

    public function benchLifecycle()
    {
        $this->initOptimized();
        $this->container->getService('bicycle_factory_shared');
    }

    public function initPrototype()
    {
        $this->initOptimized();
    }

    public function initOptimized()
    {
        $loader = new ContainerLoader($this->getCacheDir());
        $class = $loader->load(function (Compiler $compiler) {
            $builder = $compiler->getContainerBuilder();

            $builder->addDefinition('bicycle_factory_shared')
                ->setFactory('PhpBench\Benchmarks\Container\Acme\BicycleFactory');
        });
        $this->container = new $class();
    }

    public function initUnoptimized()
    {
        $this->container = self::getContainer();
    }
}
