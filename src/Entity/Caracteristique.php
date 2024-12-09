<?php

namespace App\Entity;

use App\Repository\CaracteristiqueRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CaracteristiqueRepository::class)]
class Caracteristique
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $annee_construction = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $surface_habitable = null;

    #[ORM\Column]
    private ?int $nombre_salles_de_bain = null;

    #[ORM\Column]
    private ?int $nombre_toilettes = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 7, scale: 2)]
    private ?string $surface_cuisine = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 7, scale: 2)]
    private ?string $surface_salon = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2, nullable: true)]
    private ?string $surface_terrain = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAnneeConstruction(): ?int
    {
        return $this->annee_construction;
    }

    public function setAnneeConstruction(int $annee_construction): static
    {
        $this->annee_construction = $annee_construction;

        return $this;
    }

    public function getSurfaceHabitable(): ?string
    {
        return $this->surface_habitable;
    }

    public function setSurfaceHabitable(string $surface_habitable): static
    {
        $this->surface_habitable = $surface_habitable;

        return $this;
    }

    public function getNombreSallesDeBain(): ?int
    {
        return $this->nombre_salles_de_bain;
    }

    public function setNombreSallesDeBain(int $nombre_salles_de_bain): static
    {
        $this->nombre_salles_de_bain = $nombre_salles_de_bain;

        return $this;
    }

    public function getNombreToilettes(): ?int
    {
        return $this->nombre_toilettes;
    }

    public function setNombreToilettes(int $nombre_toilettes): static
    {
        $this->nombre_toilettes = $nombre_toilettes;

        return $this;
    }

    public function getSurfaceCuisine(): ?string
    {
        return $this->surface_cuisine;
    }

    public function setSurfaceCuisine(string $surface_cuisine): static
    {
        $this->surface_cuisine = $surface_cuisine;

        return $this;
    }

    public function getSurfaceSalon(): ?string
    {
        return $this->surface_salon;
    }

    public function setSurfaceSalon(string $surface_salon): static
    {
        $this->surface_salon = $surface_salon;

        return $this;
    }

    public function getSurfaceTerrain(): ?string
    {
        return $this->surface_terrain;
    }

    public function setSurfaceTerrain(?string $surface_terrain): static
    {
        $this->surface_terrain = $surface_terrain;

        return $this;
    }
}
