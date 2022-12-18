<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\FactureRepository;

#[ORM\Entity(repositoryClass: FactureRepository::class)]
class Facture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private $idfacture;

    #[ORM\Column]
    private $datefacture = null;

    #[ORM\Column(length: 255)]
    private ?string $facturepdf = null;

    #[ORM\Column]
    private ?int $iddevis;

    #[ORM\Column]
    private ?int $idcommande;

    #[ORM\Column]
    private ?float $total;



    public function getIdfacture(): ?string
    {
        return $this->idfacture;
    }

    public function getDatefacture()
    {
        return $this->datefacture;
    }

    public function setDatefacture($datefacture): self
    {
        $this->datefacture = $datefacture;

        return $this;
    }

    public function getFacturepdf(): ?string
    {
        return $this->facturepdf;
    }

    public function setFacturepdf(string $facturepdf): self
    {
        $this->facturepdf = $facturepdf;

        return $this;
    }

    public function getIddevis(): ?string
    {
        return $this->iddevis;
    }

    public function setIddevis(string $iddevis): self
    {
        $this->iddevis = $iddevis;

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

    public function getTotal(): ?string
    {
        return $this->total;
    }

    public function setTotal(string $total): self
    {
        $this->total = $total;

        return $this;
    }


}
