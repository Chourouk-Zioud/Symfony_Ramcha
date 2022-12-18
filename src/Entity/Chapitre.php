<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ChapitreRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
#[ORM\Entity(repositoryClass: ChapitreRepository::class)]
#[Vich\Uploadable]

class Chapitre
{


    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: "idChapitre")]
    private ?int $idChapitre=null ;

    #[Vich\UploadableField(mapping: 'products', fileNameProperty: 'imageName')]
    private ?File $imageFile = null;

    #[ORM\Column(type: 'string', nullable: true)]
    private ?string $imageName = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "champ obligatoire")]
    #[Assert\Length(min:2,max: 25,minMessage: "le nom est trés court",maxMessage: "le nom est trés long")]
    private ?string $nomchapitre=null;


    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "champ obligatoire")]
    #[Assert\Length(min:2,max: 10,minMessage: "le nom est trés court",maxMessage: "le nom est trés long")]
    private ?string $languechapitre=null;


    #[ORM\Column( length: 255)]
    #[Assert\NotBlank(message: "champ obligatoire")]
    #[Assert\Length(min:2,max: 10,minMessage: "le nom est trés court",maxMessage: "le nom est trés long")]
    private ?string $typechapitre=null;

    #[ORM\ManyToOne(inversedBy: 'chapitres')]
    #[ORM\JoinColumn(nullable: false , referencedColumnName: "idfirst",name: "idfirst_id",onDelete: "CASCADE")]
    private ?CoursFirst $idfirst = null;


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

   /* #[ORM\ManyToOne(inversedBy: 'chapitres')]
    //#[ORM\JoinColumn(nullable: false)]
    private ?CoursFirst $cour = null;*/

   /* #[ORM\ManyToOne(targetEntity: CoursFirst::class, inversedBy: 'chapitres')]
    private ?CoursFirst $cour = null;
*/


    public function getidChapitre(): ?int
    {
        return $this->idChapitre;
    }


    public function setidChapitre(?int $idChapitre): void
    {
        $this->idChapitre = $idChapitre;
    }


    public function getNomchapitre(): ?string
    {
        return $this->nomchapitre;
    }


    public function setNomchapitre(?string $nomchapitre): void
    {
        $this->nomchapitre = $nomchapitre;
    }


    public function getLanguechapitre(): ?string
    {
        return $this->languechapitre;
    }


    public function setLanguechapitre(?string $languechapitre): void
    {
        $this->languechapitre = $languechapitre;
    }


    public function getTypechapitre(): ?string
    {
        return $this->typechapitre;
    }


    public function setTypechapitre(?string $typechapitre): void
    {
        $this->typechapitre = $typechapitre;
    }


    public function getIdfirst(): ?CoursFirst
    {
        return $this->idfirst;
    }


    public function setIdfirst(?CoursFirst $idfirst): void
    {
        $this->idfirst = $idfirst;
    }

    public function getCour(): ?CoursFirst
    {
        return $this->cour;
    }

    public function setCour(?CoursFirst $cour): self
    {
        $this->cour = $cour;

        return $this;
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




}
