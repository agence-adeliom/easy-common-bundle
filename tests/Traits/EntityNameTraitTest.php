<?php

namespace Adeliom\EasyCommonBundle\Tests\Traits;

use Adeliom\EasyCommonBundle\Traits\EntityNameTrait;
use Adeliom\EasyCommonBundle\Tests\Util\SerializerGroupsAccessor;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Serializer\Annotation\Groups;

#[CoversClass(EntityNameTrait::class)]
final class EntityNameTraitTest extends TestCase
{
    public function testNameCanBeSetAndStringified(): void
    {
        $entity = new class {
            use EntityNameTrait;
        };

        $nameProperty = new \ReflectionProperty($entity::class, 'name');

        self::assertSame('', (string) $entity);

        $entity->setName('Sample name');

        self::assertSame('Sample name', $entity->getName());
        self::assertSame('Sample name', (string) $entity);
        self::assertSame(['main'], SerializerGroupsAccessor::extract($nameProperty->getAttributes(Groups::class)[0]));
    }
}
