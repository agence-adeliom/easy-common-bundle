<?php

namespace Adeliom\EasyCommonBundle\Tests;

use Adeliom\EasyCommonBundle\DependencyInjection\EasyCommonExtension;
use Adeliom\EasyCommonBundle\EasyCommonBundle;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(EasyCommonBundle::class)]
final class EasyCommonBundleTest extends TestCase
{
    public function testBundleReturnsExpectedContainerExtension(): void
    {
        $bundle = new EasyCommonBundle();
        $extension = $bundle->getContainerExtension();

        self::assertInstanceOf(EasyCommonExtension::class, $extension);
        self::assertSame('easy_common', $extension?->getAlias());
    }
}
