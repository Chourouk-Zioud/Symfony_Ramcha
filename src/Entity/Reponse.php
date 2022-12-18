<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ReponseRepository;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ReponseRepository::class)]
class Reponse
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name:"idReponse")]
    private ?int $idreponse = null;

    #[ORM\Column(name:"Text" ,length: 255)]
    #[Assert\Length(
        min : 10,
        max :100,
        minMessage :" Text comporte au moins {{ limit }} caractères",
        maxMessage:"Text  doit comporter au plus {{ limit }} caractères")]
    #[Assert\NotBlank(message: "text  is required")]
    private ?string  $text  = null;

    #[ORM\Column(name:"status" ,length: 255)]
    private ?string  $status  = null;

    /**
     * @return string|null
     */
    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    /**
     * @param string|null $prenom
     */
    public function setPrenom(?string $prenom): void
    {
        $this->prenom = $prenom;
    }

    #[ORM\Column(name:"prenom" ,length: 255)]
    private ?string  $prenom  = null;

    #[ORM\Column(name: "daterep",type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $daterep  = null;

    /**
     * @return \DateTimeInterface|null
     */
    public function getDaterep(): ?\DateTimeInterface
    {
        return $this->daterep;
    }

    /**
     * @param \DateTimeInterface|null $daterep
     */
    public function setDaterep(?\DateTimeInterface $daterep): void
    {
        $this->daterep = $daterep;
    }

    #[ORM\Column(name: "idReclamation")]
    private ?int $idreclamation  = null;

    public function getIdreponse(): ?int
    {
        return $this->idreponse;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getIdreclamation(): ?int
    {
        return $this->idreclamation;
    }

    public function setIdreclamation(int $idreclamation): self
    {
        $this->idreclamation = $idreclamation;

        return $this;
    }

}
