<?php

namespace Adeliom\EasyCommonBundle\Traits;

use Ramsey\Uuid\Doctrine\UuidGenerator;
use Ramsey\Uuid\UuidInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;


trait EntityIdTrait
{
    /**
     * The unique auto incremented primary key.
     *
     * @var int|null
     * @Groups("main")
     * @ORM\Id
     * @ORM\Column(type="integer", options={"unsigned": true})
     * @ORM\GeneratedValue
     */
    protected $id;

    public function getId(): ?int
    {
        return $this->id;
    }
}
