<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\DevisserviceRepository;

#[ORM\Entity(repositoryClass: DevisserviceRepository::class)]
class Devisservice
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private $iddevisservice;

    #[ORM\Column]
    private $datedevis = null;

    #[ORM\Column]
    private ?float $total;

    #[ORM\Column]
    private ?int $idcommandesevice;

    public function getIddevisservice(): ?string
    {
        return $this->iddevisservice;
    }

    public function getDatedevis()
    {
        return $this->datedevis;
    }

    public function setDatedevis($datedevis): self
    {
        $this->datedevis = $datedevis;

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

    public function getIdcommandesevice(): ?string
    {
        return $this->idcommandesevice;
    }

    public function setIdcommandesevice(string $idcommandesevice): self
    {
        $this->idcommandesevice = $idcommandesevice;

        return $this;
    }


}
