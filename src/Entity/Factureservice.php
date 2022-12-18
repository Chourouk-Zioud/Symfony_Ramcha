<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\FactureserviceRepository;


#[ORM\Entity(repositoryClass: FactureserviceRepository::class)]
class Factureservice
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private $idfactureservice;

    #[ORM\Column(length: 255)]
    private ?string $factureservicepdf = null;

    #[ORM\Column]
    private $datefacture = null;

    #[ORM\Column]
    private ?int $idcommandeservice;

    #[ORM\Column]
    private ?int $iddevisservice;

    #[ORM\Column]
    private ?float $total;

    public function getIdfactureservice(): ?string
    {
        return $this->idfactureservice;
    }

    public function getFactureservicepdf(): ?string
    {
        return $this->factureservicepdf;
    }

    public function setFactureservicepdf(string $factureservicepdf): self
    {
        $this->factureservicepdf = $factureservicepdf;

        return $this;
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

    public function getIdcommandeservice(): ?string
    {
        return $this->idcommandeservice;
    }

    public function setIdcommandeservice(string $idcommandeservice): self
    {
        $this->idcommandeservice = $idcommandeservice;

        return $this;
    }

    public function getIddevisservice(): ?string
    {
        return $this->iddevisservice;
    }

    public function setIddevisservice(string $iddevisservice): self
    {
        $this->iddevisservice = $iddevisservice;

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
