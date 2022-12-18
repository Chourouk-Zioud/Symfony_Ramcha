<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\CategoriearticleRepository;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CategoriearticleRepository::class)]
class Categoriearticle
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: "idCategorie")]
    private ?int $idcategorie = null;

    #[ORM\Column(name: "libelle",length: 255)]
    #[Assert\Length(
        min : 3,
        max :25,
        minMessage :" libelle comporte au moins {{ limit }} caractères",
        maxMessage:"libelle  doit comporter au plus {{ limit }} caractères")]
    #[Assert\NotBlank(message: "libelle is required")]
    private ?string  $libelle = null;

    #[ORM\Column(name: "discription",length: 255)]
    #[Assert\NotBlank(message: "description is required")]
    private ?string  $discription = null;

    public function getIdcategorie(): ?int
    {
        return $this->idcategorie;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(?string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getDiscription(): ?string
    {
        return $this->discription;
    }

    public function setDiscription(?string $discription): self
    {
        $this->discription = $discription;

        return $this;
    }

    public function __toString(): string
    {
        return $this->getLibelle();
    }
}
