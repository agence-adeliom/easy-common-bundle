<?php

namespace Adeliom\EasyCommonBundle\Tests\Traits;

use Adeliom\EasyCommonBundle\Traits\EntityTimestampableTrait;
use Gedmo\Mapping\Annotation\Timestampable;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Serializer\Annotation\Groups;

#[CoversClass(EntityTimestampableTrait::class)]
final class EntityTimestampableTraitTest extends TestCase
{
    public function testTraitInitializesDatesAndKeepsGroupsAttributes(): void
    {
        $entity = new class {
            use EntityTimestampableTrait;
        };

        $createdAtProperty = new \ReflectionProperty($entity::class, 'createdAt');
        $updatedAtProperty = new \ReflectionProperty($entity::class, 'updatedAt');

        self::assertInstanceOf(\DateTimeInterface::class, $entity->getCreatedAt());
        self::assertInstanceOf(\DateTimeInterface::class, $entity->getUpdatedAt());
        self::assertSame(['main'], $createdAtProperty->getAttributes(Groups::class)[0]->newInstance()->getGroups());
        self::assertSame(['main'], $updatedAtProperty->getAttributes(Groups::class)[0]->newInstance()->getGroups());
        self::assertCount(1, $createdAtProperty->getAttributes(Timestampable::class));
        self::assertCount(1, $updatedAtProperty->getAttributes(Timestampable::class));
    }

    public function testTraitAllowsUpdatingUpdatedAt(): void
    {
        $entity = new class {
            use EntityTimestampableTrait;
        };

        $updatedAt = new \DateTimeImmutable('2026-03-05 12:34:56');
        $entity->setUpdatedAt($updatedAt);

        self::assertSame($updatedAt, $entity->getUpdatedAt());
    }
}
