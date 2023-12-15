<?php

namespace App\Entity;

use App\Repository\PokemonRepository;
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

    #[ORM\ManyToOne(inversedBy: 'pokemon')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Type $type = null;

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

    public function getType(): ?Type
    {
        return $this->type;
    }

    public function setType(?Type $type): static
    {
        $this->type = $type;

        return $this;
    }
}
