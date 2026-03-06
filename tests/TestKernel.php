<?php

namespace Adeliom\EasyCommonBundle\Tests;

use Adeliom\EasyCommonBundle\EasyCommonBundle;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Kernel;

final class TestKernel extends Kernel
{
    use MicroKernelTrait;

    public function registerBundles(): iterable
    {
        yield new FrameworkBundle();
        yield new EasyCommonBundle();
    }

    public function getCacheDir(): string
    {
        return sys_get_temp_dir().'/easy-common-bundle-tests/cache';
    }

    public function getLogDir(): string
    {
        return sys_get_temp_dir().'/easy-common-bundle-tests/log';
    }

    protected function configureContainer(ContainerConfigurator $container): void
    {
        $container->extension('framework', [
            'secret' => 'easy-common-test-secret',
            'test' => true,
            'router' => ['utf8' => true],
            'http_method_override' => false,
            'handle_all_throwables' => true,
        ]);
    }
}
