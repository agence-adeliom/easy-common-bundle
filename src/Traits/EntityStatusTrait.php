<?php

namespace Adeliom\EasyCommonBundle\Traits;

use Adeliom\EasyCommonBundle\Enum\ThreeStateStatusEnum;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


trait EntityStatusTrait
{
    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean")
     * @Assert\Valid
     */
    private $status = false;


    public function getStatus(): bool
    {
        return $this->status;
    }

    public function setStatus(bool $status = false): void
    {
        $this->status = $status;
    }

}
