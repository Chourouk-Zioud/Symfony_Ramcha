<?php

namespace App\Entity;

use App\Repository\CommandeserviceRepository;
use Doctrine\DBAL\Types\Types;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommandeserviceRepository::class)]
class Commandeservice
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[ORM\ManyToMany(targetEntity: CommandeserviceServiceUtilisateur::class, mappedBy: 'idcommandeservice')]
    private ?int $idcommandeservice = null;

    #[ORM\Column]
    #[Assert\GreaterThanOrEqual('today', message: 'Entrer une date superieure ou égale à aujourdhui')]
    private \DateTime $daterequis;

    #[ORM\Column]
    private $datecommandeservice;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Entrer la status de la commande')]
    private ?string $statuscommande ="En cours de traitement";

    #[ORM\Column]
    #[Assert\GreaterThanOrEqual(1,message: 'Entrer un nombre de jours valide')]
    #[Assert\NotBlank(message: 'Entrer le nombre des jours')]

    private ?int $nbjour;


    public function getIdcommandeservice(): ?int
    {
        return $this->idcommandeservice;
    }


    public function setIdcommandeservice(?int $idcommandeservice): void
    {
        $this->idcommandeservice = $idcommandeservice;
    }


    public function getDaterequis(): \DateTimeInterface
    {
        return $this->daterequis;
    }

    public function setDaterequis(\DateTimeInterface $daterequis): void
    {
        $this->daterequis = $daterequis;
    }


    public function getDatecommandeservice()
    {
        return $this->datecommandeservice;
    }


    public function setDatecommandeservice($datecommandeservice): void
    {
        $this->datecommandeservice = $datecommandeservice;
    }


    public function getStatuscommande(): ?string
    {
        return $this->statuscommande;
    }


    public function setStatuscommande(?string $statuscommande): void
    {
        $this->statuscommande = $statuscommande;
    }


    public function getNbjour()
    {
        return $this->nbjour;
    }


    public function setNbjour(?int $nbjour): void
    {
        $this->nbjour = $nbjour;
    }




}
