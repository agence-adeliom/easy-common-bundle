<?php

namespace Adeliom\EasyCommonBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Adeliom\EasyCommonBundle\DependencyInjection\EasyCommonExtension;

class EasyCommonBundle extends Bundle
{
    /**
     * @return ExtensionInterface|null The container extension
     */
    public function getContainerExtension()
    {
        return new EasyCommonExtension();
    }
}
