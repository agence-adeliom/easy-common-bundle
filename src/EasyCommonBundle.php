<?php

namespace Adeliom\EasyCommonBundle;

use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Adeliom\EasyCommonBundle\DependencyInjection\EasyCommonExtension;

class EasyCommonBundle extends Bundle
{
    public function getContainerExtension(): ?ExtensionInterface
    {
        return new EasyCommonExtension();
    }
}
