<?php

namespace Adeliom\EasyCommonBundle\Traits;

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
    protected ?int $id = null;

    public function getId(): ?int
    {
        return $this->id;
    }
}
