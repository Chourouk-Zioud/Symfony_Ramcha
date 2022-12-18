<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Form\FormTypeInterface;

use Doctrine\DBAL\Types\Types;

use App\Repository\CategorieserviceRepository;use function Symfony\Component\String\u;
use Symfony\Component\Validator\Constraints as Assert;
#[ORM\Entity(repositoryClass:  CategorieserviceRepository::class)]

class Categorieservice
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $idcategorieservice;


    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "champ obligatoire")]
    #[Assert\Length(min:4,max: 255,minMessage: "le nom est trés court",maxMessage: "le nom est trés long")]
    private  string $nomcategorieservice;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "champ obligatoire")]
    #[Assert\Length(min:2,max: 255,minMessage: "La description est trés court",maxMessage: "La description est trés long")]
    private  ?string $descriptioncategorieservice;

    public function getidcategorieservice(): int
    {
        return $this->idcategorieservice;
    }

    public function setidcategorieservice(int $idcategorieservice): void
    {
        $this->idcategorieservice = $idcategorieservice;
    }

    public function getNomcategorieservice(): ?string
    {
        return $this->nomcategorieservice;
    }

    public function setNomcategorieservice(?string $nomcategorieservice): void
    {
        $this->nomcategorieservice = $nomcategorieservice;
    }

    public function getDescriptioncategorieservice(): ?string
    {
        return $this->descriptioncategorieservice;
    }

    public function setDescriptioncategorieservice(?string $descriptioncategorieservice): void
    {
        $this->descriptioncategorieservice = $descriptioncategorieservice;
    }

}
