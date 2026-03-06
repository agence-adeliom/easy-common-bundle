<?php

declare(strict_types=1);

namespace Adeliom\EasyCommonBundle\Tests\Traits;

use Adeliom\EasyCommonBundle\Enum\ThreeStateStatusEnum;
use Adeliom\EasyCommonBundle\Traits\EntityThreeStateStatusTrait;
use Doctrine\ORM\Mapping\Column;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints\NotBlank;

#[CoversClass(EntityThreeStateStatusTrait::class)]
final class EntityThreeStateStatusTraitTest extends TestCase
{
    public function testTraitInitializesAndValidatesKnownStates(): void
    {
        $entity = new class {
            use EntityThreeStateStatusTrait;
        };

        $stateProperty = new \ReflectionProperty($entity::class, 'state');

        self::assertSame(ThreeStateStatusEnum::UNPUBLISHED, $entity->getState());
        self::assertSame('unpublished', $entity->getStateAsString());
        self::assertTrue($entity->isState(ThreeStateStatusEnum::UNPUBLISHED));

        $entity->setState(ThreeStateStatusEnum::PENDING);

        self::assertSame(ThreeStateStatusEnum::PENDING, $entity->getState());
        self::assertTrue($entity->isState(ThreeStateStatusEnum::PENDING));
        self::assertFalse($entity->isState(ThreeStateStatusEnum::PUBLISHED));
        self::assertSame(['main'], $stateProperty->getAttributes(Groups::class)[0]->newInstance()->getGroups());
        self::assertCount(1, $stateProperty->getAttributes(NotBlank::class));
        self::assertCount(1, $stateProperty->getAttributes(Column::class));
    }

    public function testTraitRejectsUnknownStateAtRuntime(): void
    {
        $entity = new class {
            use EntityThreeStateStatusTrait;
        };

        $this->expectException(\TypeError::class);
        $entity->setState('archived');
    }

    public function testTraitRejectsNullStateAtRuntime(): void
    {
        $entity = new class {
            use EntityThreeStateStatusTrait;
        };

        $this->expectException(\TypeError::class);

        $entity->setState(null);
    }
}
