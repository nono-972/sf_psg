<?php

namespace App\Entity;

use App\Repository\RecompenseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RecompenseRepository::class)]
class Recompense
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column]
    private ?int $annee = null;

    #[ORM\ManyToOne(inversedBy: 'recompenses')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Trophee $trophee = null;

    /**
     * @var Collection<int, Joueur>
     */
    #[ORM\ManyToMany(targetEntity: Joueur::class, inversedBy: 'recompenses')]
    private Collection $joueur;

    public function __construct()
    {
        $this->joueur = new ArrayCollection();
    }

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

    public function getAnnee(): ?int
    {
        return $this->annee;
    }

    public function setAnnee(int $annee): static
    {
        $this->annee = $annee;

        return $this;
    }

    public function getTrophee(): ?Trophee
    {
        return $this->trophee;
    }

    public function setTrophee(?Trophee $trophee): static
    {
        $this->trophee = $trophee;

        return $this;
    }

    /**
     * @return Collection<int, Joueur>
     */
    public function getJoueur(): Collection
    {
        return $this->joueur;
    }

    public function addJoueur(Joueur $joueur): static
    {
        if (!$this->joueur->contains($joueur)) {
            $this->joueur->add($joueur);
        }

        return $this;
    }

    public function removeJoueur(Joueur $joueur): static
    {
        $this->joueur->removeElement($joueur);

        return $this;
    }
}
