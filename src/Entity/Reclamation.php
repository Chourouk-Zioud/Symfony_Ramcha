<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ReclamationRepository;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

#[ORM\Entity(repositoryClass: ReclamationRepository::class)]
#[Vich\Uploadable]
class Reclamation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: "idReclamation")]
    private ?int $idreclamation = null;

    #[Vich\UploadableField(mapping: 'rec', fileNameProperty: 'imageName')]
    private ?File $imageFile = null;

    #[ORM\Column(name: "image_name",length: 255)]
    private ?string  $imageName = 'no.jpg';

    #[ORM\Column(name: "nom",length: 255)]
    #[Assert\Length(
        min : 3,
        max :10,
        minMessage :" nom  comporte au moins {{ limit }} caractères",
        maxMessage:"nom   doit comporter au plus {{ limit }} caractères")]
    #[Assert\NotBlank(message: "nom is required")]
    private ?string  $nom = null;

    #[ORM\Column(name: "prenom",length: 255)]
    #[Assert\Length(
        min : 3,
        max :10,
        minMessage :" prenom comporte au moins {{ limit }} caractères",
        maxMessage:"prenom  doit comporter au plus {{ limit }} caractères")]
    #[Assert\NotBlank(message: "prenom is required")]
    private ?string  $prenom = null;

    #[ORM\Column(name: "email",length: 255,unique: true)]
    #[Assert\NotBlank(message: "email  is required")]
    #[Assert\Email(message: "the email '{{ value }}' is not a valid email")]
    private ?string  $email = null;

    //#[ORM\Column(name: "screenshot",length: 255)]
    //private ?string  $screenshot = null;

    #[ORM\Column(name: "numero_mobile")]
    #[Assert\Length(
        min : 8,
        max :8,
        minMessage :" numero Mobile comporte au moins {{ limit }} caractères",
        maxMessage:"numero Mobile  doit comporter au plus {{ limit }} caractères")]
    #[Assert\NotBlank(message: "numero Mobile is required")]
    private ?int $numeroMobile = null;

    //#[ORM\Column(name: "date_creation",type: Types::DATE_MUTABLE)]
    //#[Assert\NotBlank(message: "date Creation is required")]
    //private ?\DateTimeInterface $dateCreation = null;

    //#[ORM\Column(name: "date_traitement",type: Types::DATE_MUTABLE)]
    //#[Assert\NotBlank(message: "date Traitement is required")]
    //private ?\DateTimeInterface $dateTraitement = null;

    #[ORM\Column(name: "description",length: 255)]
    #[Assert\Length(
        min : 5,
        max :100,
        minMessage :" description comporte au moins {{ limit }} caractères",
        maxMessage:"description  doit comporter au plus {{ limit }} caractères")]
    #[Assert\NotBlank(message: "description is required")]
    private ?string  $description = null;

    /*********************************************************/

    //#[ORM\Column(name: "status",length: 255)]
    //#[Assert\NotBlank(message: "status is required")]
    //private ?string  $status = "Non traitée";

    /*********************************************************/

    #[ORM\Column(name: "nomServcie",length: 255)]

    #[Assert\NotBlank(message: "nom service is required")]
    private ?string  $nomservcie = null;




    public function getIdreclamation(): ?int
    {
        return $this->idreclamation;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }



    public function getNumeroMobile(): ?int
    {
        return $this->numeroMobile;
    }

    public function setNumeroMobile(int $numeroMobile): self
    {
        $this->numeroMobile = $numeroMobile;

        return $this;
    }



    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getNomservcie(): ?string
    {
        return $this->nomservcie;
    }

    public function setNomservcie(?string $nomservcie): self
    {
        $this->nomservcie = $nomservcie;

        return $this;
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

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function setImageName(?string $imageName): self
    {
        $this->imageName = $imageName;

        return $this;
    }

}
