<?php

namespace Adeliom\EasyCommonBundle\Tests\Traits;

use Adeliom\EasyCommonBundle\Traits\EntityIdTrait;
use Adeliom\EasyCommonBundle\Tests\Util\SerializerGroupsAccessor;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Serializer\Annotation\Groups;

#[CoversClass(EntityIdTrait::class)]
final class EntityIdTraitTest extends TestCase
{
    public function testTraitDeclaresExpectedAttributesAndDefaults(): void
    {
        $entity = new class {
            use EntityIdTrait;
        };

        $property = new \ReflectionProperty($entity::class, 'id');

        self::assertNull($entity->getId());
        self::assertCount(1, $property->getAttributes(Id::class));
        self::assertCount(1, $property->getAttributes(Column::class));
        self::assertCount(1, $property->getAttributes(GeneratedValue::class));
        self::assertSame(['main'], SerializerGroupsAccessor::extract($property->getAttributes(Groups::class)[0]));
    }
}
