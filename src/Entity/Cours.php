<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\CoursRepository;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CoursRepository::class)]

class Cours
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]

    private ?int $idcours=null;


    #[ORM\Column( length: 255)]
    #[Assert\NotBlank(message: "champ obligatoire")]
    #[Assert\Length(min:2,max: 30,minMessage: "le nom est trés court",maxMessage: "le nom est trés long")]
    private ?string $nomcours=null;

    #[Assert\NotBlank(message: "champ obligatoire")]
    #[Assert\Length(min:2,max: 30,minMessage: " trés court",maxMessage: " trés long")]
    #[ORM\Column(length: 255)]
    private ?string $categoriecours=null;

    #[Assert\NotBlank(message: "champ obligatoire")]
    #[Assert\Length(min:2,max: 40,minMessage: " trés court",maxMessage: " trés long")]
    #[ORM\Column(length: 255)]
    private ?string $sujetcours=null;

    #[Assert\NotBlank(message: "champ obligatoire")]
    #[Assert\Length(min:2,max: 10,minMessage: " trés court",maxMessage: " trés long")]
    #[ORM\Column(length: 255)]
    private ?string $niveaucours=null;

   /*#[ORM\ManyToMany(targetEntity: Chapitre::class, mappedBy: 'courss')]
    private Collection $chapitres;*/

    public function __construct()
    {
        $this->chapitres = new ArrayCollection();
    }
    public function getIdcours(): ?int
    {
        return $this->idcours;
    }


    public function setIdcours(?int $idcours): void
    {
        $this->idcours = $idcours;
    }


    public function getNomcours(): ?string
    {
        return $this->nomcours;
    }


    public function setNomcours(?string $nomcours): void
    {
        $this->nomcours = $nomcours;
    }

    public function getCategoriecours(): ?string
    {
        return $this->categoriecours;
    }

    public function setCategoriecours(?string $categoriecours): void
    {
        $this->categoriecours = $categoriecours;
    }

    public function getSujetcours(): ?string
    {
        return $this->sujetcours;
    }

    public function setSujetcours(?string $sujetcours): void
    {
        $this->sujetcours = $sujetcours;
    }

    public function getNiveaucours(): ?string
    {
        return $this->niveaucours;
    }

    public function setNiveaucours(?string $niveaucours): void
    {
        $this->niveaucours = $niveaucours;
    }


    /*
    public function getChapitres(): Collection
    {
        return $this->chapitres;
    }

    public function addChapitres(Chapitre $chapitre): self
    {
        if (!$this->chapitres->contains($chapitre)) {
            $this->chapitres->add($chapitre);
        }

        return $this;
    }

    public function removeChapitres(Chapitre $chapitre): self
    {
        $this->chapitres->removeElement($chapitre);

        return $this;
    }*/
}
