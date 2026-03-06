<?php

namespace Adeliom\EasyCommonBundle\Tests\Traits;

use Adeliom\EasyCommonBundle\Traits\EntityPublishableTrait;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Serializer\Annotation\Groups;

#[CoversClass(EntityPublishableTrait::class)]
final class EntityPublishableTraitTest extends TestCase
{
    public function testTraitHandlesPublicationWindow(): void
    {
        $entity = new class {
            use EntityPublishableTrait;
        };

        $publishDateProperty = new \ReflectionProperty($entity::class, 'publishDate');
        $unpublishDateProperty = new \ReflectionProperty($entity::class, 'unpublishDate');

        self::assertInstanceOf(\DateTimeInterface::class, $entity->getPublishDate());

        $entity->setPublishDate(new \DateTimeImmutable('-1 day'));
        $entity->setUnpublishDate(new \DateTimeImmutable('+1 day'));

        self::assertTrue($entity->isPublished());
        self::assertSame(['main'], $publishDateProperty->getAttributes(Groups::class)[0]->newInstance()->getGroups());
        self::assertSame(['main'], $unpublishDateProperty->getAttributes(Groups::class)[0]->newInstance()->getGroups());

        $entity->setUnpublishDate(new \DateTimeImmutable('-1 hour'));

        self::assertFalse($entity->isPublished());
    }
}
