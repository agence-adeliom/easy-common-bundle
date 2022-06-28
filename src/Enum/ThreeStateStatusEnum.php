<?php

namespace Adeliom\EasyCommonBundle\Enum;

use Adeliom\EasyCommonBundle\Helper\Enum;

/**
 * ThreeStateStatus enum
 * @method static ThreeStateStatusEnum UNPUBLISHED()
 * @method static ThreeStateStatusEnum PENDING()
 * @method static ThreeStateStatusEnum PUBLISHED()
 */
final class ThreeStateStatusEnum extends Enum
{
    private const UNPUBLISHED = 'unpublished';
    private const PENDING = 'pending';
    private const PUBLISHED = 'published';
}
