<?php

namespace App\Entity;

use App\Repository\ProximiteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    /**
     * @var Collection<int, Localisation>
     */
    #[ORM\ManyToMany(targetEntity: Localisation::class, mappedBy: 'proximite')]
    private Collection $localisations;

    public function __construct()
    {
        $this->localisations = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, Localisation>
     */
    public function getLocalisations(): Collection
    {
        return $this->localisations;
    }

    public function addLocalisation(Localisation $localisation): static
    {
        if (!$this->localisations->contains($localisation)) {
            $this->localisations->add($localisation);
            $localisation->addProximite($this);
        }

        return $this;
    }

    public function removeLocalisation(Localisation $localisation): static
    {
        if ($this->localisations->removeElement($localisation)) {
            $localisation->removeProximite($this);
        }

        return $this;
    }
}
