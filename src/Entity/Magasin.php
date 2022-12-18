<?php

namespace App\Entity;

use App\Repository\MagasinRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: MagasinRepository::class)]
#[UniqueEntity(fields: "emailmagasin",message: "The Email is already used")]
class Magasin
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: "IdMagasin")]
    private ?int $idmagasin = null;

    #[ORM\Column(name: "nomMagasin",length: 255)]
    #[Assert\NotBlank(message: "nom magasin is required")]
    private ?string  $nommagasin = null;

    #[ORM\Column(name: "adresseMagasin",length: 255)]
    #[Assert\NotBlank(message: "adresse magasin is required")]
    private ?string  $adressemagasin = null;

    #[ORM\Column(name: "emailMagasin",length: 255,unique: true)]
    #[Assert\NotBlank(message: "email magasin is required")]
    #[Assert\Email(message: "the email '{{ value }}' is not a valid email")]
    private ?string  $emailmagasin = null;

    #[ORM\Column(name: "telMagasin")]
    #[Assert\NotBlank(message: "tel magasin is required")]
    private ?int $telmagasin = null;

    /**
     * @return string|null
     */
    public function getMagasin(): ?string
    {
        return $this->magasin;
    }

    /**
     * @param string|null $magasin
     */
    public function setMagasin(?string $magasin): void
    {
        $this->magasin = $magasin;
    }

    public function getIdmagasin(): ?int
    {
        return $this->idmagasin;
    }

    public function getNommagasin(): ?string
    {
        return $this->nommagasin;
    }

    public function setNommagasin(?string $nommagasin): self
    {
        $this->nommagasin = $nommagasin;

        return $this;
    }

    public function getAdressemagasin(): ?string
    {
        return $this->adressemagasin;
    }

    public function setAdressemagasin(?string $adressemagasin): self
    {
        $this->adressemagasin = $adressemagasin;

        return $this;
    }

    public function getEmailmagasin(): ?string
    {
        return $this->emailmagasin;
    }

    public function setEmailmagasin(?string $emailmagasin): self
    {
        $this->emailmagasin = $emailmagasin;

        return $this;
    }

    public function getTelmagasin(): ?int
    {
        return $this->telmagasin;
    }

    public function setTelmagasin(?int $telmagasin): self
    {
        $this->telmagasin = $telmagasin;

        return $this;
    }

    public function __toString(): string
    {
        return $this->getNommagasin();
    }
}
