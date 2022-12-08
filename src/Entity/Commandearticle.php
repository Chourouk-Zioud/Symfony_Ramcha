<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\CommandearticleRepository;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: CommandearticleRepository::class)]
class Commandearticle
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[ORM\ManyToMany(targetEntity: CommandearticleArticleUtilisateur::class, mappedBy: 'idcommande')]
    private $idcommande;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Entrer le mode de livraison')]
    private ?string $modelivraison;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Entrer la status de la commande')]
    private ?string $statuslivraison = "En cours de traitement";

    #[ORM\Column]
    private $datecommande ;


    public function getIdcommande()
    {
        return $this->idcommande;
    }

    public function setIdcommande($idcommande): void
    {
        $this->idcommande = $idcommande;
    }

    public function getModelivraison(): ?string
    {
        return $this->modelivraison;
    }

    public function setModelivraison(?string $modelivraison): void
    {
        $this->modelivraison = $modelivraison;
    }

    public function getStatuslivraison(): ?string
    {
        return $this->statuslivraison;
    }

    public function setStatuslivraison(?string $statuslivraison): void
    {
        $this->statuslivraison = $statuslivraison;
    }

    public function getDatecommande()
    {
        return $this->datecommande;
    }

    public function setDatecommande($datecommande): void
    {
        $this->datecommande = $datecommande;
    }




}
