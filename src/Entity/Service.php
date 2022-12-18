<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use Doctrine\DBAL\Types\Types;

use App\Repository\ServiceRepository;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
#[ORM\Entity(repositoryClass: ServiceRepository::class)]
#[Vich\Uploadable]
class Service
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private  ?int $idservice;
    #[Vich\UploadableField(mapping: 'products', fileNameProperty: 'imageName')]
    private ?File $imageFile = null;

    #[ORM\Column(type: 'string', nullable: true)]
    private ?string $imageName = null;
    #[Assert\NotBlank(message: "champ obligatoire")]
    #[Assert\Length(min:2,max: 60,minMessage: "le nom est trés court",maxMessage: "le nom est trés long")]
    #[ORM\Column(length: 255)]
    private ?string$nomservice;
    #[Assert\NotBlank(message: "champ obligatoire")]
    #[Assert\Length(min:1,max: 10,minMessage: "le nom est trés court",maxMessage: "le nom est trés long")]
    #[Assert\Positive(message: "champ invalid")]
    #[ORM\Column]
    private  ?int $nbreouvrier;
    #[Assert\NotBlank(message: "champ obligatoire")]
    #[Assert\Positive(message: "champ invalid")]
    #[ORM\Column]
    private  ?float $prixservice;
    #[Assert\NotBlank(message: "champ obligatoire")]
    #[Assert\Length(min:2,max: 255,minMessage: "La descriptionest trés court",maxMessage: "La description est trés long")]
    #[ORM\Column(length: 255)]
    private  ?string $descriptionservice;
    #[Assert\NotBlank(message: "champ obligatoire")]
    #[Assert\Length(min:2,max: 10,minMessage: "Date invalide",maxMessage: "Date invalide")]
    #[Assert\Positive(message: "champ invalid")]
    #[Assert\Date]
    #[ORM\Column]
    private  $datedebutservice ;
    #[Assert\NotBlank(message: "champ obligatoire")]
    #[Assert\Length(min:2,max: 10,minMessage: "Date invalide",maxMessage: "Date invalide")]
    #[Assert\Positive(message: "champ invalid")]
    #[Assert\Date]
    #[ORM\Column]
    private   $datefinservice ;
    #[Assert\NotBlank(message: "champ obligatoire")]
    #[Assert\Length(min:2,max: 13,minMessage: "Disponibilité ",maxMessage: "Disponibilité")]

    #[ORM\Column(length: 255)]
    private ?string $disponibiliteservice;
    #[Assert\NotBlank(message: "champ obligatoire")]
    #[Assert\Positive(message: "champ invalid")]

    #[ORM\Column]
    private  $idcategorieservice ;


    public function getIdcategorieservice()
    {
        return $this->idcategorieservice;
    }


    public function setIdcategorieservice(Categorieservice $idcategorieservice): void
    {
        $this->idcategorieservice = $idcategorieservice->getidcategorieservice();
    }






/*
    #[ORM\ManyToOne(inversedBy: 'idcategorieservice')]
    private ?Categorieservice $idcategorieservice ;*/




    public function getIdservice(): ?int
    {
        return $this->idservice;
    }


    public function setIdservice(?int $idservice): void
    {
        $this->idservice = $idservice;
    }


    public function getNomservice(): ?string
    {
        return $this->nomservice;
    }


    public function setNomservice(?string $nomservice): void
    {
        $this->nomservice = $nomservice;
    }


    public function getNbreouvrier(): ?int
    {
        return $this->nbreouvrier;
    }


    public function setNbreouvrier(?int $nbreouvrier): void
    {
        $this->nbreouvrier = $nbreouvrier;
    }


    public function getPrixservice(): ?float
    {
        return $this->prixservice;
    }


    public function setPrixservice(?float $prixservice): void
    {
        $this->prixservice = $prixservice;
    }


    public function getDescriptionservice(): ?string
    {
        return $this->descriptionservice;
    }

    /**
     * @param string|null $descriptionservice
     */
    public function setDescriptionservice(?string $descriptionservice): void
    {
        $this->descriptionservice = $descriptionservice;
    }

    /**
     * @return mixed
     */
    public function getDatedebutservice()
    {
        return $this->datedebutservice;
    }


    public function setDatedebutservice($datedebutservice): void
    {
        $this->datedebutservice = $datedebutservice;
    }


    public function getDatefinservice()
    {
        return $this->datefinservice;
    }


    public function setDatefinservice($datefinservice): void
    {
        $this->datefinservice = $datefinservice;
    }


    public function getDisponibiliteservice(): ?string
    {
        return $this->disponibiliteservice;
    }


    public function setDisponibiliteservice(?string $disponibiliteservice): void
    {
        $this->disponibiliteservice = $disponibiliteservice;
    }
    /**
     * @param  File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $imageFile
     */

    public function setImageFile( $imageFile = null): void
    {
        $this->imageFile = $imageFile;

    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageName(?string $imageName): void
    {
        $this->imageName = $imageName;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }












}
