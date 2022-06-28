<?php

namespace Adeliom\EasyCommonBundle\Traits;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

trait EntityTimestampableTrait
{
    #[Groups('main')]
    #[ORM\Column(type: 'datetime')]
    #[Gedmo\Timestampable(on: "create")]
    protected \DateTimeInterface $createdAt;

    #[Groups('main')]
    #[ORM\Column(type: 'datetime')]
    #[Gedmo\Timestampable(on: "update")]
    protected \DateTimeInterface $updatedAt;

    /**
     * EntityTimestampableTrait constructor.
     */
    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->updatedAt = new \DateTime();
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }
}
