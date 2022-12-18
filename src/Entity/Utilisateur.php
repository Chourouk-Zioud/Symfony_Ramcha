<?php

namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;
use App\Repository\UtilisateurRepository;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;





#[UniqueEntity(fields:('loginuser'),message: 'Email deja existe') ]
#[ORM\Entity(repositoryClass: UtilisateurRepository::class)]
#[Vich\Uploadable]
class Utilisateur implements UserInterface
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $iduser = null;

    #[Vich\UploadableField(mapping:'products', fileNameProperty:'imageName')]
    private ?File $imageFile = null;

    #[ORM\Column(type: 'string', nullable: true)]
    private ?string $imageName = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank (message:'veuillez entrer votre nom !')]
    #[Assert\Length(min: 2, minMessage:'Votre nom doit contenir au minimum {{ limit }}  caractères ')]
    #[Assert\Regex(
        pattern: '/^[a-z]+$/i'
        ,message: 'Verifier votre nom',
        htmlPattern: '^[a-zA-Z]+$'
    )]
    #[Groups('utilisateur:read')]
    private ?string $nomuser ;


    #[ORM\Column(length: 255)]
    #[Assert\NotBlank (message:'veuillez entrer votre prenom !')]
    #[Assert\Length(min: 2, minMessage:'Votre prenom doit contenir au minimum {{ limit }}  caractères ')]
    #[Assert\Regex(
        pattern: '/^[a-z]+$/i'
        ,message: 'Verifier votre prenom',
        htmlPattern: '^[a-zA-Z]+$'
    )]
    #[Groups('utilisateur:read')]
    private ?string $prenomuser ;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank (message:'veuillez entrer votre adresse !')]
    #[Groups('utilisateur:read')]
    private ?string $adressuser ;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank (message:'veuillez entrer votre mot de passe !')]
    #[Assert\Length(min: 8, minMessage: "Votre mot de passe doit contenir minimum 8 cartères ")]
    private ?string $passwuser ;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank (message:'veuillez entrer votre Num de Tel !')]
    #[Assert\Regex("/^[0-9]{8}$/" , message: 'Verifier votre Num de Tel')]
    #[Groups('utilisateur:read')]
    private ?string $numuser ;


    #[ORM\Column]
    #[Assert\LessThanOrEqual('-12 years', message: 'Veuillez entrer une date de naissance valide !')]
    #[Groups('utilisateur:read')]
    private  ?\DateTime $ddnuser ;


    #[ORM\Column]
    #[Assert\NotBlank (message:'veuillez entrer votre Code Postal !')]
    #[Assert\Positive (message:'Votre Code Postale doit etre positive !')]
    #[Assert\Regex("/^[0-9]{4}$/" , message: 'Votre Code postal doit contenir 4 chiffres')]
    #[Groups('utilisateur:read')]
    private ?int $codepostaluser ;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank (message:'veuillez entrer votre CIN !')]
    #[Assert\Regex("/^[0-9]{8}$/" , message: 'Verifier votre CIN')]
    #[Groups('utilisateur:read')]
    private ?string $cinuser;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank (message:"Veuillez entrer votre Email !")]
    #[Assert\Email(message:"Email '{{ value }}' n'est pas valide")]
    #[Groups('utilisateur:read')]
    private ?string $loginuser;

    #[ORM\Column(length: 255)]
    private ?string $libelledemande = null;

    #[ORM\Column(length: 255)]
    private ?string $dispop = null;

    #[ORM\Column(length: 255)]
    #[Assert\Length(min: 3, minMessage:'Verifier l\experience ')]
    private ?string $experp = null;

    #[ORM\Column(length: 255)]
    #[Assert\Length(min: 3, minMessage:'verifier le diplome ')]
    #[Assert\Regex(
        pattern: '/^[a-z]+$/i'
        ,message: 'Verifier le diplome',
        htmlPattern: '^[a-zA-Z]+$'
    )]
    private ?string $diplomep = null;

    #[ORM\Column(length: 255)]
    private ?string $postep = null;

    #[ORM\Column(length: 255)]
    #[Assert\Regex("/^[0-9]{3}$/" , message: 'Verifier le salaire')]
    private ?string $salairep = null;


    #[ORM\Column(length: 255)]
    private ?string $role = 'user';



    #[ORM\Column(length: 255)]
    private ?string $verify = null;


    public function getIduser(): ?int
    {
        return $this->iduser;
    }


    public function setIduser(?int $iduser): void
    {
        $this->iduser = $iduser;
    }


    public function getNomuser(): ?string
    {
        return $this->nomuser;
    }


    public function setNomuser(?string $nomuser): void
    {
        $this->nomuser = $nomuser;
    }


    public function getPrenomuser(): ?string
    {
        return $this->prenomuser;
    }


    public function setPrenomuser(?string $prenomuser): void
    {
        $this->prenomuser = $prenomuser;
    }


    public function getAdressuser(): ?string
    {
        return $this->adressuser;
    }


    public function setAdressuser(?string $adressuser): void
    {
        $this->adressuser = $adressuser;
    }


    public function getPasswuser(): ?string
    {
        return $this->passwuser;
    }

    public function setPasswuser(?string $passwuser): void
    {
        $this->passwuser = $passwuser;
    }

    public function getNumuser(): ?string
    {
        return $this->numuser;
    }

    public function setNumuser(?string $numuser): void
    {
        $this->numuser = $numuser;
    }

    public function getDdnuser(): ?\DateTimeInterface
    {
        return $this->ddnuser;
    }

    public function setDdnuser(?\DateTimeInterface $ddnuser): void
    {
        $this->ddnuser = $ddnuser;
    }

    public function getCodepostaluser(): ?int
    {
        return $this->codepostaluser;
    }

    public function setCodepostaluser(?int $codepostaluser): void
    {
        $this->codepostaluser = $codepostaluser;
    }


    public function getCinuser(): ?string
    {
        return $this->cinuser;
    }


    public function setCinuser(?string $cinuser): void
    {
        $this->cinuser = $cinuser;
    }


    public function getLoginuser(): ?string
    {
        return $this->loginuser;
    }

    public function setLoginuser(?string $loginuser): void
    {
        $this->loginuser = $loginuser;
    }


    public function getLibelledemande(): ?string
    {
        return $this->libelledemande;
    }


    public function setLibelledemande(?string $libelledemande): void
    {
        $this->libelledemande = $libelledemande;
    }

    public function getDispop(): ?string
    {
        return $this->dispop;
    }


    public function setDispop(?string $dispop): void
    {
        $this->dispop = $dispop;
    }


    public function getExperp(): ?string
    {
        return $this->experp;
    }


    public function setExperp(?string $experp): void
    {
        $this->experp = $experp;
    }


    public function getDiplomep(): ?string
    {
        return $this->diplomep;
    }


    public function setDiplomep(?string $diplomep): void
    {
        $this->diplomep = $diplomep;
    }


    public function getPostep(): ?string
    {
        return $this->postep;
    }


    public function setPostep(?string $postep): void
    {
        $this->postep = $postep;
    }


    public function getSalairep(): ?string
    {
        return $this->salairep;
    }


    public function setSalairep(?string $salairep): void
    {
        $this->salairep = $salairep;
    }


    public function getRole(): ?string
    {
        return $this->role;
    }


    public function setRole(?string $role): void
    {
        $this->role = $role;
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

    public function getVerify(): ?string
    {
        return $this->verify;
    }


    public function setVerify(?string $verify): void
    {
        $this->verify = $verify;
    }


    public function getRoles()
    {
        // TODO: Implement getRoles() method.
    }

    public function getPassword()
    {
        // TODO: Implement getPassword() method.
    }




    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function getUsername()
    {
        // TODO: Implement getUsername() method.
    }

}
