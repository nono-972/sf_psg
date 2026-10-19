<?php

namespace App\Entity;

use App\Repository\PositionRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PositionRepository::class)]
class Position
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $nom_secondaire = null;

    #[ORM\ManyToMany(targetEntity: Joueur::class, mappedBy: 'positions')]
    private Collection $joueurs;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getNomSecondaire(): ?string
    {
        return $this->nom_secondaire;
    }

    public function setNomSecondaire(string $nom_secondaire): static
    {
        $this->nom_secondaire = $nom_secondaire;

        return $this;
    }

    public function getJoueurs(): Collection
    {
        return $this->joueurs;
    }

    public function setJoueurs(?Joueur $joueur): static{
        // unset the owning side of the relation if necessary
        if ($joueur === null && $this->joueur !== null) {
            $this->joueur->setPosition(null);
        }

        // set the owning side of the relation if necessary
        if ($joueur !== null && $joueur->getPosition() !== $this) {
            $joueur->setPosition($this);
        }

        $this->joueur = $joueur;

        return $this;
    }
}
