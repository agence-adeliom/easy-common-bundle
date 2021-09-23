<?php

namespace Adeliom\EasyCommonBundle\Traits;

use Adeliom\EasyCommonBundle\Enum\ThreeStateStatusEnum;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;


trait EntityThreeStateStatusTrait
{
    /**
     * @var string|null
     * @Groups("main")
     * @ORM\Column(length=100)
     * @Assert\NotBlank
     */
    private $state;

    /**
     * EntityThreeStateStatusTrait constructor.
     */
    public function __construct()
    {
        $this->state = ThreeStateStatusEnum::UNPUBLISHED();
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function setState(?string $state): void
    {
        if($state){
            ThreeStateStatusEnum::assertValidValue($state);
        }
        $this->state = $state;
    }

    public function isState(?string $state): bool
    {
        return $this->state == ThreeStateStatusEnum::search($state);
    }

}
