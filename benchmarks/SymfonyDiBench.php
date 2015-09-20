<?php

namespace PhpBench\Benchmarks\Container;

use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * @beforeMethod init
 * @iterations 4
 */
class SymfonyDiBench extends AbstractBench
{
    private $container;

    public function init()
    {
        $builder = new ContainerBuilder();
        $builder->register('bicycle_factory', 'PhpBench\Benchmarks\Container\Acme\BicycleFactory');
        $this->container = $builder;
    }

    /**
     * @revs 1000
     */
    public function benchGet()
    {
        $this->container->get('bicycle_factory');
    }
}
