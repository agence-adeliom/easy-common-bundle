<?php

namespace Adeliom\EasyCommonBundle\Traits;

use Adeliom\EasyCommonBundle\Enum\ThreeStateStatusEnum;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

trait EntityStatusTrait
{
    #[Assert\Valid]
    #[ORM\Column(type: 'boolean')]
    private bool $status = false;

    public function getStatus(): bool
    {
        return $this->status;
    }

    public function setStatus(bool $status = false): void
    {
        $this->status = $status;
    }

}
