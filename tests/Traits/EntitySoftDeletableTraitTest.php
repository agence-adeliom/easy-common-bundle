<?php

namespace Adeliom\EasyCommonBundle\Tests\Traits;

use Adeliom\EasyCommonBundle\Traits\EntitySoftDeletableTrait;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(EntitySoftDeletableTrait::class)]
final class EntitySoftDeletableTraitTest extends TestCase
{
    public function testTraitTracksDeletedState(): void
    {
        $entity = new class {
            use EntitySoftDeletableTrait;
        };

        $deletedAtProperty = new \ReflectionProperty($entity::class, 'deletedAt');

        self::assertFalse($entity->isDeleted());
        self::assertNull($entity->getDeletedAt());

        $deletedAtProperty->setValue($entity, new \DateTimeImmutable());

        self::assertTrue($entity->isDeleted());

        $entity->recover();

        self::assertFalse($entity->isDeleted());
        self::assertNull($entity->getDeletedAt());
    }
}
