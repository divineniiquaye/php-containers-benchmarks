<?php

namespace PhpBench\Benchmarks\Container;

use Aura\Di\Container;
use Aura\Di\ContainerBuilder;
use Aura\Di\Injection\InjectionFactory;
use Aura\Di\Resolver\Reflector;
use Aura\Di\Resolver\Resolver;

/**
 * @Groups({"aura-di"}, extend=true)
 */
class AuraDiBench extends ContainerBenchCase
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
        $this->container->newInstance('PhpBench\Benchmarks\Container\Acme\BicycleFactory');
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
        $builder = new ContainerBuilder();
        $container = $builder->newInstance();

        //alternatively you can do
        //$container = new Container(new InjectionFactory(new Resolver(new Reflector())));

        $container->set('bicycle_factory', $container->lazyNew('PhpBench\Benchmarks\Container\Acme\BicycleFactory'));

        $this->container = $container;
    }
}
