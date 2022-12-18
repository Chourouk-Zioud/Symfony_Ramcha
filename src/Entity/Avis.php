<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\AvisRepository;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: AvisRepository::class)]
class Avis
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: "idAvis")]
    private ?int $idavis = null;

    #[ORM\Column(name: "detailAvisService",length: 255)]
    #[Assert\Length(
        min : 5,
        max :100,
        minMessage :" detail avis service comporte au moins {{ limit }} caractères",
        maxMessage:"detail avis service doit comporter au plus {{ limit }} caractères")]
    #[Assert\NotBlank(message: "detail is required")]
    private ?string  $detailavisservice = null;

    #[ORM\Column(name: "noteService")]
    #[Assert\NotBlank(message: "Article note is required")]
    #[Assert\LessThanOrEqual(5)]
    #[Assert\LessThanOrEqual(5)]
    private ?int $noteservice = null;

    #[ORM\Column(name: "idArticle")]
    private ?int $idarticle = null;

    #[ORM\Column(name: "idUser")]
    private ?int $iduser = null;

    public function getIdavis(): ?int
    {
        return $this->idavis;
    }

    public function getDetailavisservice(): ?string
    {
        return $this->detailavisservice;
    }

    public function setDetailavisservice(string $detailavisservice): self
    {
        $this->detailavisservice = $detailavisservice;

        return $this;
    }

    public function getNoteservice(): ?int
    {
        return $this->noteservice;
    }

    public function setNoteservice(int $noteservice): self
    {
        $this->noteservice = $noteservice;

        return $this;
    }

    public function getIdarticle(): ?int
    {
        return $this->idarticle;
    }

    public function setIdarticle(int $idarticle): self
    {
        $this->idarticle = $idarticle;

        return $this;
    }

    public function getIduser(): ?int
    {
        return $this->iduser;
    }

    public function setIduser(int $iduser): self
    {
        $this->iduser = $iduser;

        return $this;
    }

}
