<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\DevisRepository;
use Dompdf\Dompdf;
use Dompdf\Options;


#[ORM\Entity(repositoryClass: DevisRepository::class)]
class Devis
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private $iddevis;

    #[ORM\Column]
    private $datedevis = null;

    #[ORM\Column]
    private ?float $totalht;

    #[ORM\Column]
    private ?float $total;

    #[ORM\Column]
    private ?int $idcommande;



    public function getIddevis(): ?string
    {
        return $this->iddevis;
    }

    public function getDatedevis()
    {
        return $this->datedevis;
    }

    public function setDatedevis( $datedevis): self
    {
        $this->datedevis = $datedevis;

        return $this;
    }

    public function getTotalht(): ?string
    {
        return $this->totalht;
    }

    public function setTotalht(string $totalht): self
    {
        $this->totalht = $totalht;

        return $this;
    }

    public function getTotal(): ?string
    {
        return $this->total;
    }

    public function setTotal(string $total): self
    {
        $this->total = $total;

        return $this;
    }

    public function getIdcommande(): ?string
    {
        return $this->idcommande;
    }

    public function setIdcommande(string $idcommande): self
    {
        $this->idcommande = $idcommande;

        return $this;
    }


}
