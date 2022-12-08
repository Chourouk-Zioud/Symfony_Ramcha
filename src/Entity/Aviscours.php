<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\AviscoursRepository;
use Symfony\Component\Validator\Constraints as Assert;
#[ORM\Entity(repositoryClass: AviscoursRepository::class)]


class Aviscours
{

    #[ORM\Column]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    private ?int $idaviscours=null;



    #[ORM\Column]
    #[Assert\Positive(message: "champ invalid")]
    private ?int $rate=null;


    #[ORM\Column]
    #[Assert\Positive(message: "champ invalid")]
    private ?int $idutilisateur=null;

    /*#[ORM\Column]
    #[Assert\Positive(message: "champ invalid")]
    private ?int $idcours=null;*/


    #[ORM\Column(length: 255)]
    #[Assert\Positive(message: "champ invalid")]
    #[Assert\NotBlank(message: "champ obligatoire")]
    #[Assert\Length(min:2,max: 255,minMessage: "le nom est trés court",maxMessage: "le nom est trés long")]
    private ?string $commentaire=null;


    public function getIdaviscours(): ?int
    {
        return $this->idaviscours;
    }

    public function setIdaviscours(?int $idaviscours): void
    {
        $this->idaviscours = $idaviscours;
    }


    public function getRate(): ?int
    {
        return $this->rate;
    }

    public function setRate(?int $rate): void
    {
        $this->rate = $rate;
    }


    public function getIdutilisateur(): ?int
    {
        return $this->idutilisateur;
    }


    public function setIdutilisateur(?int $idutilisateur): void
    {
        $this->idutilisateur = $idutilisateur;
    }

    /*public function getIdcours(): ?int
    {
        return $this->idcours;
    }


    public function setIdcours(?int $idcours): void
    {
        $this->idcours = $idcours;
    }*/

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }


    public function setCommentaire(?string $commentaire): void
    {
        $this->commentaire = $commentaire;
    }


}
