<?php

namespace App\Entity;

use App\Repository\PokemonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PokemonRepository::class)]
class Pokemon
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column]
    private ?int $point_de_vie = null;

    #[ORM\Column]
    private ?int $point_attaque = null;

    #[ORM\ManyToMany(targetEntity: Type::class, inversedBy: 'pokemons')]
    private Collection $types;

    #[ORM\ManyToOne(inversedBy: 'pokemons')]
    private ?User $dresseur = null;

    public function __construct()
    {
        $this->types = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
         $this->id = $id;
         return $this;
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

    public function getPointDeVie(): ?int
    {
        return $this->point_de_vie;
    }

    public function setPointDeVie(int $point_de_vie): static
    {
        $this->point_de_vie = $point_de_vie;

        return $this;
    }

    public function getPointAttaque(): ?int
    {
        return $this->point_attaque;
    }

    public function setPointAttaque(int $point_attaque): static
    {
        $this->point_attaque = $point_attaque;

        return $this;
    }

    /**
     * @return Collection<int, Type>
     */
    public function getTypes(): Collection
    {
        return $this->types;
    }

    public function addType(Type $type): static
    {
        if (!$this->types->contains($type)) {
            $this->types->add($type);
        }

        return $this;
    }

    public function removeType(Type $type): static
    {
        $this->types->removeElement($type);

        return $this;
    }

    public function getDresseur(): ?User
    {
        return $this->dresseur;
    }

    public function setDresseur(?User $dresseur): static
    {
        $this->dresseur = $dresseur;

        return $this;
    }
}
