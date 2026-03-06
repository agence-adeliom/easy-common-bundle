<?php

namespace Adeliom\EasyCommonBundle\Tests\Traits;

use Adeliom\EasyCommonBundle\Traits\EntityStatusTrait;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(EntityStatusTrait::class)]
final class EntityStatusTraitTest extends TestCase
{
    public function testStatusDefaultsToFalseAndCanBeUpdated(): void
    {
        $entity = new class {
            use EntityStatusTrait;
        };

        self::assertFalse($entity->getStatus());

        $entity->setStatus(true);

        self::assertTrue($entity->getStatus());
    }
}
