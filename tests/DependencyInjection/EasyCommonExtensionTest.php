<?php

namespace Adeliom\EasyCommonBundle\Tests\DependencyInjection;

use Adeliom\EasyCommonBundle\DependencyInjection\EasyCommonExtension;
use Adeliom\EasyCommonBundle\Tests\TestKernel;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;

#[CoversClass(EasyCommonExtension::class)]
final class EasyCommonExtensionTest extends TestCase
{
    public function testExtensionLoadsIntoContainer(): void
    {
        $container = new ContainerBuilder();
        $extension = new EasyCommonExtension();

        $extension->load([], $container);

        self::assertSame('easy_common', $extension->getAlias());
        self::assertArrayHasKey('service_container', $container->getDefinitions());
    }
}

final class EasyCommonBundleBootTest extends KernelTestCase
{
    protected static function getKernelClass(): string
    {
        return TestKernel::class;
    }

    public function testKernelBootsAndRegistersBundleExtension(): void
    {
        self::bootKernel();

        self::assertTrue(self::getContainer()->hasParameter('kernel.secret'));
        self::assertSame('easy-common-test-secret', self::getContainer()->getParameter('kernel.secret'));
    }
}
