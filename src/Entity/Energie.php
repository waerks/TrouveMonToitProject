<?php

namespace App\Entity;

use App\Repository\EnergieRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EnergieRepository::class)]
class Energie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $classe_energetique = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 7, scale: 0)]
    private ?string $consomation_energetique = null;

    #[ORM\Column]
    private ?bool $double_vitrage = null;

    #[ORM\Column]
    private ?bool $pompes_chaleur = null;

    #[ORM\Column]
    private ?bool $panneaux_solaires = null;

    #[ORM\OneToOne(mappedBy: 'energie', cascade: ['persist', 'remove'])]
    private ?Annonce $annonce = null;

    #[ORM\ManyToOne(inversedBy: 'energies')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Chauffage $chauffage = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClasseEnergetique(): ?string
    {
        return $this->classe_energetique;
    }

    public function setClasseEnergetique(string $classe_energetique): static
    {
        $this->classe_energetique = $classe_energetique;

        return $this;
    }

    public function getConsomationEnergetique(): ?string
    {
        return $this->consomation_energetique;
    }

    public function setConsomationEnergetique(string $consomation_energetique): static
    {
        $this->consomation_energetique = $consomation_energetique;

        return $this;
    }

    public function isDoubleVitrage(): ?bool
    {
        return $this->double_vitrage;
    }

    public function setDoubleVitrage(bool $double_vitrage): static
    {
        $this->double_vitrage = $double_vitrage;

        return $this;
    }

    public function isPompesChaleur(): ?bool
    {
        return $this->pompes_chaleur;
    }

    public function setPompesChaleur(bool $pompes_chaleur): static
    {
        $this->pompes_chaleur = $pompes_chaleur;

        return $this;
    }

    public function isPanneauxSolaires(): ?bool
    {
        return $this->panneaux_solaires;
    }

    public function setPanneauxSolaires(bool $panneaux_solaires): static
    {
        $this->panneaux_solaires = $panneaux_solaires;

        return $this;
    }

    public function getAnnonce(): ?Annonce
    {
        return $this->annonce;
    }

    public function setAnnonce(Annonce $annonce): static
    {
        // set the owning side of the relation if necessary
        if ($annonce->getEnergie() !== $this) {
            $annonce->setEnergie($this);
        }

        $this->annonce = $annonce;

        return $this;
    }

    public function getChauffage(): ?Chauffage
    {
        return $this->chauffage;
    }

    public function setChauffage(?Chauffage $chauffage): static
    {
        $this->chauffage = $chauffage;

        return $this;
    }
}
