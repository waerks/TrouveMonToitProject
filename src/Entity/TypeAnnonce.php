<?php

namespace App\Entity;

use App\Repository\TypeAnnonceRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypeAnnonceRepository::class)]
class TypeAnnonce
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $type_annonce = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeAnnonce(): ?string
    {
        return $this->type_annonce;
    }

    public function setTypeAnnonce(string $type_annonce): static
    {
        $this->type_annonce = $type_annonce;

        return $this;
    }
}
