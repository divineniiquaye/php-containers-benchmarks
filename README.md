PHP Container Benchmarking Suite
================================

[![Build Status](https://api.travis-ci.com/divineniiquaye/php-containers-benchmarks.svg)](https://travis-ci.com/github/divineniiquaye/php-containers-benchmarks)

This benchmarking suite compares PHP Dependency Injection Containers. It is intended to be a base for developing a standard benchmarking suite for all of the PHP containers out there.

The benchmarked containers:

- [PHP-DI](https://github.com/PHP-DI/PHP-DI).
- [Symfony Dependency Injection](https://github.com/symfony/DependencyInjection).
- [Pimple](https://github.com/silexphp/Pimple).
- [PHPBench Container](https://github.com/phpbench/phpbench).
- [Illuminate (Laravel) Container](https://github.com/illuminate/container)
- [Php League Container](http://container.thephpleague.com/)
- [Laminas Service Manager](https://github.com/laminas/laminas-servicemanager)
- [Aura DI](https://github.com/auraphp/aura.di)
- [Rade DI](https://github.com/divineniiquaye/rade-di)
- [Nette DI](https://github.com/nette/di)
- [Spiral DI](https://github.com/spiral/core)
- [Chubbyphp Container](https://github.com/chubbyphp/chubbyphp-container)

Disclaimer
----------

We take no responsiblity for the accuracy of these benchmarks. If you want to
be sure of the results please clone this repository, look at the code, and run
the benchmarks yourself.

If you are a container maintainer and you notice that the benchmarks are not
fair, then please make a pull request.

The benchmarks do not cover all contingencies, infact they are currently quite
limited. Please feel free to make pull requests as required.

Versions
--------

```
aura/di                             4.1.0   A serializable dependency injection container with constructor and setter injection...
illuminate/container                v8.32.1 The Illuminate Container package.
league/container                    3.3.4   A fast and intuitive dependency injection container.
php-di/php-di                       6.3.0   The dependency injection container for humans
pimple/pimple                       v3.4.0  Pimple, a simple Dependency Injection Container
symfony/dependency-injection        v5.2.4  Allows you to standardize and centralize the way objects are constructed in your application
laminas/laminas-servicemanager      3.6.4   Factory-Driven Dependency Injection Container
divineniiquaye/rade-di              v0.2.2  A simple and smart dependency injection for PHP
nette/di                            v3.0.8  Nette Dependency Injection Container: Flexible, compiled and full-featured DIC...
spiral/core                         v2.7.7  IoC container, IoC scopes, factory, memory, configuration interfaces
chubbyphp/chubbyphp-container       2.0.0   A simple PSR-11 container implementation.
```

Results
-------

- All containers are expected to be optimized except in the `unoptimized
  test`.

Subjects (all executed 1000 times):

- `GetOptimizedNode`: Return a shared service (expected cache effect).
- `GetUnoptimized`: Return a shared service without optimization (i.e. no
  dumping of the container, etc).
- `GetPrototype`: Return a new instance of the service.
- `Lifecycle`: Instantiate the container and return a shared service.

## Suite #134628aebbf72563dc8eb71878a72e15134e96f6 2021-03-14 04:33:15

50 iterations, 1000 revolutions, 5 warmup revolutions, stdev < 3%

### Environment

Check [Travis Build 220028115](https://travis-ci.com/github/divineniiquaye/php-containers-benchmarks/builds/220028115)

### Time

benchmark | benchGetOptimized | benchGetUnoptimized | benchGetPrototype | benchLifecycle
 --- | --- | --- | --- | --- 
| SymfonyDiBench             | 1.083μs | 3.148μs | 2.313μs  | 6.901μs  |
| ChubbyphpBench             | 1.118μs |         | 2.578μs  | 6.993μs  |
| AuraDiBench                | 1.265μs |         | 15.630μs | 44.120μs |
| RadeDiBench                | 1.260μs | 1.169μs | 1.226μs  | 6.746μs  |
| NetteDiBench               | 1.167μs | 1.545μs | 4.285μs  | 53.867μs |
| PimpleBench                | 1.297μs |         | 3.989μs  | 10.669μs |
| PhpDiBench                 | 1.156μs | 1.812μs | 21.129μs | 35.230μs |
| IlluminateBench            | 6.029μs | 6.783μs | 19.134μs | 28.475μs |
| LeagueBench                | 13.859μs|         | 18.107μs | 35.448μs |
| LaminasServiceManagerBench | 1.142μs | 1.150μs | 4.689μs  | 12.142μs |
| SpiralDiBench              | 1.237μs | 1.795μs | 1.245μs  | 4.939μs  |

**NOTE**: Memory is `memory_get_peak_usage` after executing the operation 1000 times.

### Memory

benchmark | benchGetOptimized | benchGetUnoptimized | benchGetPrototype | benchLifecycle
 --- | --- | --- | --- | ---
| SymfonyDiBench             | 1,307,696b | 1,781,808b | 1,307,696b | 1,307,272b |
| ChubbyphpBench             | 1,156,560b |            | 1,156,560b | 1,156,136b |
| AuraDiBench                | 1,320,608b |            | 1,320,608b | 1,320,184b |
| RadeDiBench                | 1,313,968b | 1,317,832b | 1,313,968b | 2,459,984b |
| NetteDiBench               | 1,328,104b | 1,397,168b | 1,366,432b | 1,327,680b |
| PimpleBench                | 1,182,520b |            | 1,182,520b | 1,182,096b |
| PhpDiBench                 | 1,476,200b | 1,447,848b | 1,528,120b | 4,561,880b |
| IlluminateBench            | 1,426,560b | 1,426,568b | 1,426,568b | 1,426,144b |
| LeagueBench                | 1,316,936b |            | 1,316,936b | 2,559,256b |
| LaminasServiceManagerBench | 1,404,864b | 1,404,864b | 1,404,864b | 3,396,144b |
| SpiralDiBench              | 1,327,496b | 1,327,496b | 1,327,496b | 1,732,232b |

### Detail by subject

Sorted by mode

#### subject: benchGetOptimized, its: 50, revs: 1000

| benchmark                  | mem_peak   | best     | mean     | mode     | worst    | stdev   | rstdev | diff   |
 --- | --- | --- | --- | --- | --- | --- | --- | ---
| SymfonyDiBench             | 1,307,696b | 1.053μs  | 1.086μs  | 1.083μs  | 1.139μs  | 0.021μs | 1.95%  | 1.00x  |
| ChubbyphpBench             | 1,156,560b | 1.104μs  | 1.138μs  | 1.118μs  | 1.190μs  | 0.028μs | 2.43%  | 1.05x  |
| LaminasServiceManagerBench | 1,404,864b | 1.110μs  | 1.154μs  | 1.142μs  | 1.205μs  | 0.025μs | 2.19%  | 1.06x  |
| PhpDiBench                 | 1,476,200b | 1.130μs  | 1.163μs  | 1.156μs  | 1.206μs  | 0.018μs | 1.51%  | 1.07x  |
| NetteDiBench               | 1,328,104b | 1.140μs  | 1.189μs  | 1.167μs  | 1.247μs  | 0.032μs | 2.69%  | 1.09x  |
| SpiralDiBench              | 1,327,496b | 1.204μs  | 1.255μs  | 1.237μs  | 1.312μs  | 0.028μs | 2.26%  | 1.16x  |
| RadeDiBench                | 1,313,968b | 1.204μs  | 1.252μs  | 1.260μs  | 1.303μs  | 0.028μs | 2.26%  | 1.15x  |
| AuraDiBench                | 1,320,608b | 1.239μs  | 1.280μs  | 1.265μs  | 1.332μs  | 0.025μs | 1.94%  | 1.18x  |
| PimpleBench                | 1,182,520b | 1.240μs  | 1.296μs  | 1.297μs  | 1.358μs  | 0.030μs | 2.32%  | 1.19x  |
| IlluminateBench            | 1,426,560b | 5.856μs  | 6.046μs  | 6.029μs  | 6.206μs  | 0.066μs | 1.09%  | 5.57x  |
| LeagueBench                | 1,316,936b | 13.581μs | 13.906μs | 13.859μs | 14.502μs | 0.182μs | 1.31%  | 12.80x |

#### subject: benchGetPrototype, its: 50, revs: 1000

| benchmark                  | mem_peak   | best     | mean     | mode     | worst    | stdev   | rstdev | diff   |
 --- | --- | --- | --- | --- | --- | --- | --- | ---
| RadeDiBench                | 1,313,968b | 1.199μs  | 1.240μs  | 1.226μs  | 1.299μs  | 0.026μs | 2.07%  | 1.00x  |
| SpiralDiBench              | 1,327,496b | 1.214μs  | 1.251μs  | 1.245μs  | 1.312μs  | 0.022μs | 1.77%  | 1.01x  |
| SymfonyDiBench             | 1,307,696b | 2.225μs  | 2.310μs  | 2.313μs  | 2.418μs  | 0.048μs | 2.07%  | 1.86x  |
| ChubbyphpBench             | 1,156,560b | 2.513μs  | 2.591μs  | 2.578μs  | 2.684μs  | 0.042μs | 1.62%  | 2.09x  |
| PimpleBench                | 1,182,520b | 3.892μs  | 4.015μs  | 3.989μs  | 4.194μs  | 0.064μs | 1.60%  | 3.24x  |
| NetteDiBench               | 1,366,432b | 4.169μs  | 4.293μs  | 4.285μs  | 4.409μs  | 0.059μs | 1.38%  | 3.46x  |
| LaminasServiceManagerBench | 1,404,864b | 4.582μs  | 4.698μs  | 4.689μs  | 4.901μs  | 0.065μs | 1.39%  | 3.79x  |
| AuraDiBench                | 1,320,608b | 15.353μs | 15.706μs | 15.630μs | 16.350μs | 0.229μs | 1.46%  | 12.67x |
| LeagueBench                | 1,316,936b | 17.904μs | 18.200μs | 18.107μs | 18.720μs | 0.196μs | 1.08%  | 14.68x |
| IlluminateBench            | 1,426,568b | 18.887μs | 19.225μs | 19.134μs | 20.148μs | 0.264μs | 1.37%  | 15.51x |
| PhpDiBench                 | 1,528,120b | 20.741μs | 21.180μs | 21.129μs | 22.004μs | 0.256μs | 1.21%  | 17.09x |

#### subject: benchGetUnoptimized, its: 50, revs: 1000

| benchmark                  | mem_peak   | best    | mean    | mode    | worst   | stdev   | rstdev | diff  |
 --- | --- | --- | --- | --- | --- | --- | --- | ---
| LaminasServiceManagerBench | 1,404,864b | 1.116μs | 1.156μs | 1.150μs | 1.214μs | 0.025μs | 2.16%  | 1.00x |
| RadeDiBench                | 1,317,832b | 1.153μs | 1.189μs | 1.169μs | 1.247μs | 0.028μs | 2.32%  | 1.03x |
| NetteDiBench               | 1,397,168b | 1.507μs | 1.559μs | 1.545μs | 1.631μs | 0.030μs | 1.95%  | 1.35x |
| SpiralDiBench              | 1,327,496b | 1.752μs | 1.808μs | 1.795μs | 1.894μs | 0.033μs | 1.84%  | 1.56x |
| PhpDiBench                 | 1,447,848b | 1.749μs | 1.811μs | 1.812μs | 1.890μs | 0.037μs | 2.03%  | 1.57x |
| SymfonyDiBench             | 1,781,808b | 3.085μs | 3.163μs | 3.148μs | 3.294μs | 0.044μs | 1.40%  | 2.74x |
| IlluminateBench            | 1,426,568b | 6.603μs | 6.769μs | 6.783μs | 7.083μs | 0.084μs | 1.24%  | 5.85x |

#### subject: benchLifecycle, its: 50, revs: 1000

| benchmark                  | mem_peak   | best     | mean     | mode     | worst    | stdev   | rstdev | diff   |
 --- | --- | --- | --- | --- | --- | --- | --- | ---
| SpiralDiBench              | 1,732,232b | 4.857μs  | 4.971μs  | 4.939μs  | 5.156μs  | 0.072μs | 1.44%  | 1.00x  |
| RadeDiBench                | 2,459,984b | 6.627μs  | 6.749μs  | 6.746μs  | 6.895μs  | 0.070μs | 1.03%  | 1.36x  |
| SymfonyDiBench             | 1,307,272b | 6.654μs  | 6.980μs  | 6.901μs  | 7.307μs  | 0.169μs | 2.42%  | 1.40x  |
| ChubbyphpBench             | 1,156,136b | 6.896μs  | 7.034μs  | 6.993μs  | 7.330μs  | 0.091μs | 1.29%  | 1.41x  |
| PimpleBench                | 1,182,096b | 10.288μs | 10.648μs | 10.669μs | 11.102μs | 0.193μs | 1.81%  | 2.14x  |
| LaminasServiceManagerBench | 3,396,144b | 11.950μs | 12.205μs | 12.142μs | 12.716μs | 0.164μs | 1.35%  | 2.46x  |
| IlluminateBench            | 1,426,144b | 28.219μs | 28.605μs | 28.475μs | 29.366μs | 0.274μs | 0.96%  | 5.75x  |
| PhpDiBench                 | 4,561,880b | 34.798μs | 35.337μs | 35.230μs | 36.550μs | 0.336μs | 0.95%  | 7.11x  |
| LeagueBench                | 2,559,256b | 34.607μs | 35.486μs | 35.448μs | 36.713μs | 0.440μs | 1.24%  | 7.14x  |
| AuraDiBench                | 1,320,184b | 43.630μs | 44.285μs | 44.120μs | 45.927μs | 0.439μs | 0.99%  | 8.91x  |
| NetteDiBench               | 1,327,680b | 52.290μs | 53.884μs | 53.867μs | 56.509μs | 0.971μs | 1.80%  | 10.84x |

Run the Benchmarks
------------------

````bash
$ composer install
$ ./vendor/bin/phpbench run --report=all
````

or

```bash
$ ./vendor/bin/phpbench run --store
$ ./vendor/bin/phpbench show latest --report=all
```

For the HTML report:

```
$ ./vendor/bin/phpbench show latest --report=all --output=container_html
```

Conclusion
----------

Keep in mind that in a well-architected application you won't call your DI Container hundreds or even thousands of times because ideally there should be as few **composition roots** as possible (but there is a good chance of needing the container in other places of the application layer - e.g. in your middleware or bootstrap files). You probably won't see difference between the fastest and the slowest DIC in the real life, but benchmarking helps identify their differences.

To sum up, when choosing a container it only depends on your needs which one suits your project best: if you have a performance-critical application then you probably want to choose a compiled container. If maximum performance is not required, but you develop a big and complex system then I would recommend a dynamic container with autowiring capabilities like [Rade DI](https://github.com/divineniiquaye/rade-di). Otherwise you can go with simpler containers.
