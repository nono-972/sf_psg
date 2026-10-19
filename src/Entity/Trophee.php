<?php

namespace App\Entity;

use App\Repository\TropheeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TropheeRepository::class)]
class Trophee
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    /**
     * @var Collection<int, Recompense>
     */
    #[ORM\OneToMany(targetEntity: Recompense::class, mappedBy: 'trophee')]
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
            $recompense->setTrophee($this);
        }

        return $this;
    }

    public function removeRecompense(Recompense $recompense): static
    {
        if ($this->recompenses->removeElement($recompense)) {
            // set the owning side to null (unless already changed)
            if ($recompense->getTrophee() === $this) {
                $recompense->setTrophee(null);
            }
        }

        return $this;
    }
}
