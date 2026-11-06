<?php

namespace App\Entity;

use App\Repository\JoueurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: JoueurRepository::class)]
class Joueur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\Column]
    private ?int $age = null;

    #[ORM\Column(length: 255)]
    private ?string $poste = null;

    #[ORM\Column(length: 255)]
    private ?string $postesecondaire = null;

    #[ORM\Column(length: 255)]
    private ?string $nationalite = null;

    #[ORM\ManyToMany(targetEntity: Position::class, inversedBy: 'joueurs')]
    private Collection $positions;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Effectif $effectif = null;

    /**
     * @var Collection<int, Recompense>
     */
    #[ORM\ManyToMany(targetEntity: Recompense::class, mappedBy: 'joueur')]
    private Collection $recompenses;

    public function __construct()
    {
        $this->recompenses = new ArrayCollection();
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): static
    {
        $this->age = $age;

        return $this;
    }

    public function getPoste(): ?string
    {
        return $this->poste;
    }

    public function setPoste(string $poste): static
    {
        $this->poste = $poste;

        return $this;
    }

    public function getPosteSecondaire(): ?string
    {
        return $this->postesecondaire;
    }

    public function setPosteSecondaire(string $postesecondaire): static
    {
        $this->postesecondaire = $postesecondaire;

        return $this;
    }

    public function getNationalite(): ?string
    {
        return $this->nationalite;
    }

    public function setNationalite(string $nationalite): static
    {
        $this->nationalite = $nationalite;

        return $this;
    }

    public function getPosition(): ?Position
    {
        return $this->position;
    }

    public function setPosition(?Position $position): static
    {
        $this->position = $position;

        return $this;
    }

    public function getEffectif(): ?Effectif
    {
        return $this->effectif;
    }

    public function setEffectif(Effectif $effectif): static
    {
        $this->effectif = $effectif;

        return $this;
    }

    /**
     * @return Collection<int, Recompense>
     */
    public function getRecompenses(): Collection
    {
        return $this->recompenses;
    }

    public function addRecompense(Recompense $recompense): static
    {
        if (!$this->recompenses->contains($recompense)) {
            $this->recompenses->add($recompense);
            $recompense->addJoueur($this);
        }

        return $this;
    }

    public function removeRecompense(Recompense $recompense): static
    {
        if ($this->recompenses->removeElement($recompense)) {
            $recompense->removeJoueur($this);
        }

        return $this;
    }
}
