<?php

namespace App\Entity;

use App\Repository\CoursFirstRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

#[ORM\Entity(repositoryClass: CoursFirstRepository::class)]
#[Vich\Uploadable]

class CoursFirst
{


    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: "idfirst")]
    private ?int $idfirst = null;


    #[Vich\UploadableField(mapping: 'products', fileNameProperty: 'imageName')]
    private ?File $imageFile = null;

    #[ORM\Column(type: 'string', nullable: true)]
    private ?string $imageName = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "champ obligatoire")]
    #[Assert\Length(min:2,max: 20,minMessage: "le nom est trés court",maxMessage: "le nom est trés long")]
    private ?string $nomcours = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "champ obligatoire")]
    #[Assert\Length(min:2,max: 30,minMessage: "le nom est trés court",maxMessage: "le nom est trés long")]
    private ?string $categoriecours = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "champ obligatoire")]
    #[Assert\Length(min:2,max: 40,minMessage: "le nom est trés court",maxMessage: "le nom est trés long")]
    private ?string $sujetcours = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "champ obligatoire")]
    #[Assert\Length(min:2,max: 10,minMessage: "le nom est trés court",maxMessage: "le nom est trés long")]
    private ?string $niveaucours = null;

    #[ORM\OneToMany(mappedBy: 'idfirst', targetEntity: Chapitre::class)]
    private Collection $chapitres;

  /* #[ORM\OneToMany(mappedBy: 'cour', targetEntity: Chapitre::class)]
    private Collection $chapitres;*/

    //#[ORM\JoinColumn(nullable: false)]


    public function __construct()
    {
        $this->idChapitre = new ArrayCollection();
        $this->chapitres = new ArrayCollection();
    }


    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }


    public function setImageFile(?File $imageFile): void
    {
        $this->imageFile = $imageFile;
    }


    public function getImageName(): ?string
    {
        return $this->imageName;
    }


    public function setImageName(?string $imageName): void
    {
        $this->imageName = $imageName;
    }


    public function getIdfirst(): ?int
    {
        return $this->idfirst;
    }


    public function setIdfirst(?int $idfirst): void
    {
        $this->idfirst = $idfirst;
    }



    public function getNomcours(): ?string
    {
        return $this->nomcours;
    }

    public function setNomcours(string $nomcours): self
    {
        $this->nomcours = $nomcours;

        return $this;
    }

    public function getCategoriecours(): ?string
    {
        return $this->categoriecours;
    }

    public function setCategoriecours(string $categoriecours): self
    {
        $this->categoriecours = $categoriecours;

        return $this;
    }

    public function getSujetcours(): ?string
    {
        return $this->sujetcours;
    }

    public function setSujetcours(string $sujetcours): self
    {
        $this->sujetcours = $sujetcours;

        return $this;
    }

    public function getNiveaucours(): ?string
    {
        return $this->niveaucours;
    }

    public function setNiveaucours(string $niveaucours): self
    {
        $this->niveaucours = $niveaucours;

        return $this;
    }


    public function getidChapitre(): Collection
    {
        return $this->idChapitre;
    }

    public function addidChapitre(Chapitre $idChapitre): self
    {
        if (!$this->idChapitre->contains($idChapitre)) {
            $this->idChapitre->add($idChapitre);
            $idChapitre->setIdfirst($this);
        }

        return $this;
    }

    public function removeidChapitre(Chapitre $idChapitre): self
    {
        if ($this->idChapitre->removeElement($idChapitre)) {
            // set the owning side to null (unless already changed)
            if ($idChapitre->getIdfirst() === $this) {
                $idChapitre->setIdfirst(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Chapitre>
     */
    public function getChapitres(): Collection
    {
        return $this->chapitres;
    }

    public function addChapitre(Chapitre $chapitre): self
    {
        if (!$this->chapitres->contains($chapitre)) {
            $this->chapitres->add($chapitre);
            $chapitre->setCour($this);
        }

        return $this;
    }

    public function removeChapitre(Chapitre $chapitre): self
    {
        if ($this->chapitres->removeElement($chapitre)) {
            // set the owning side to null (unless already changed)
            if ($chapitre->getCour() === $this) {
                $chapitre->setCour(null);
            }
        }

        return $this;
    }




}
