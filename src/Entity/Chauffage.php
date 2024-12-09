<?php

namespace App\Entity;

use App\Repository\ChauffageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    /**
     * @var Collection<int, Energie>
     */
    #[ORM\OneToMany(targetEntity: Energie::class, mappedBy: 'chauffage', orphanRemoval: true)]
    private Collection $energies;

    public function __construct()
    {
        $this->energies = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, Energie>
     */
    public function getEnergies(): Collection
    {
        return $this->energies;
    }

    public function addEnergy(Energie $energy): static
    {
        if (!$this->energies->contains($energy)) {
            $this->energies->add($energy);
            $energy->setChauffage($this);
        }

        return $this;
    }

    public function removeEnergy(Energie $energy): static
    {
        if ($this->energies->removeElement($energy)) {
            // set the owning side to null (unless already changed)
            if ($energy->getChauffage() === $this) {
                $energy->setChauffage(null);
            }
        }

        return $this;
    }
}
