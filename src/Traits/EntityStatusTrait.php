<?php

namespace Adeliom\EasyCommonBundle\Traits;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

trait EntityStatusTrait
{
    #[Assert\Valid]
    #[ORM\Column(type: \Doctrine\DBAL\Types\Types::BOOLEAN)]
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
