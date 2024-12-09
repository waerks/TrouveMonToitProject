<?php

namespace App\Entity;

use App\Repository\ProximiteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProximiteRepository::class)]
class Proximite
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $type_proximite = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeProximite(): ?string
    {
        return $this->type_proximite;
    }

    public function setTypeProximite(string $type_proximite): static
    {
        $this->type_proximite = $type_proximite;

        return $this;
    }
}
