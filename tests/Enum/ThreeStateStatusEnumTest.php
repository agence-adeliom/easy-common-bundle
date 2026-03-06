<?php

declare(strict_types=1);

namespace Adeliom\EasyCommonBundle\Tests\Enum;

use Adeliom\EasyCommonBundle\Enum\ThreeStateStatusEnum;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(ThreeStateStatusEnum::class)]
final class ThreeStateStatusEnumTest extends TestCase
{
    public function testEnumBuildsKnownValues(): void
    {
        self::assertSame('unpublished', ThreeStateStatusEnum::UNPUBLISHED->value);
        self::assertSame(ThreeStateStatusEnum::PENDING, ThreeStateStatusEnum::from('pending'));
        self::assertSame('PUBLISHED', ThreeStateStatusEnum::PUBLISHED->name);
    }

    public function testEnumRejectsUnknownValues(): void
    {
        $this->expectException(\ValueError::class);

        ThreeStateStatusEnum::from('archived');
    }
}
