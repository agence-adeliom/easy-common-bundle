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
    /**
     * @var string
     */
    private const UNPUBLISHED = 'unpublished';

    /**
     * @var string
     */
    private const PENDING = 'pending';

    /**
     * @var string
     */
    private const PUBLISHED = 'published';
}
