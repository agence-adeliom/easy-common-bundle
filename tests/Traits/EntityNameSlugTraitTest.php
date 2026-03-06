<?php

namespace Adeliom\EasyCommonBundle\Tests\Traits;

use Adeliom\EasyCommonBundle\Traits\EntityNameSlugTrait;
use Doctrine\ORM\Mapping\Column;
use Gedmo\Mapping\Annotation\Slug;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

#[CoversClass(EntityNameSlugTrait::class)]
final class EntityNameSlugTraitTest extends TestCase
{
    public function testTraitStoresNameAndSlugWithExpectedMetadata(): void
    {
        $entity = new class {
            use EntityNameSlugTrait;
        };

        $nameProperty = new \ReflectionProperty($entity::class, 'name');
        $slugProperty = new \ReflectionProperty($entity::class, 'slug');

        $entity->setName('Sample name');
        $entity->setSlug('sample-name');

        self::assertSame('Sample name', $entity->getName());
        self::assertSame('sample-name', $entity->getSlug());
        self::assertSame('Sample name', (string) $entity);
        self::assertSame(['main'], $nameProperty->getAttributes(Groups::class)[0]->newInstance()->getGroups());
        self::assertSame(['main'], $slugProperty->getAttributes(Groups::class)[0]->newInstance()->getGroups());
        self::assertCount(1, $nameProperty->getAttributes(NotBlank::class));
        self::assertSame(255, $nameProperty->getAttributes(Length::class)[0]->newInstance()->max);
        self::assertCount(1, $nameProperty->getAttributes(Column::class));
        self::assertCount(1, $slugProperty->getAttributes(Column::class));
        self::assertSame(['name'], $slugProperty->getAttributes(Slug::class)[0]->newInstance()->fields);
    }

    public function testTraitStringifiesEmptyNameAsEmptyString(): void
    {
        $entity = new class {
            use EntityNameSlugTrait;
        };

        self::assertSame('', (string) $entity);
    }
}
