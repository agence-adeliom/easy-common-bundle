<?php

namespace Adeliom\EasyCommonBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Adeliom\EasyCommonBundle\DependencyInjection\EasyCommonExtension;

class EasyCommonBundle extends Bundle
{
    public function getContainerExtension()
    {
        return new EasyCommonExtension();
    }
}
