<?php

namespace Adeliom\EasyCommonBundle\Tests\Util;

use ReflectionAttribute;

final class SerializerGroupsAccessor
{
    /**
     * @return array<int, string>
     */
    public static function extract(ReflectionAttribute $attribute): array
    {
        $instance = $attribute->newInstance();

        $reflectionProperty = new \ReflectionProperty($instance, 'groups');
        /** @var array<int, string> $groups */
        $groups = $reflectionProperty->getValue($instance);

        return $groups;
    }
}
