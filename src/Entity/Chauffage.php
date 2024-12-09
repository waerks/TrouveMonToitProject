<?php

namespace App\Entity;

use App\Repository\ChauffageRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ChauffageRepository::class)]
class Chauffage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 150)]
    private ?string $type_chauffage = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeChauffage(): ?string
    {
        return $this->type_chauffage;
    }

    public function setTypeChauffage(string $type_chauffage): static
    {
        $this->type_chauffage = $type_chauffage;

        return $this;
    }
}
