<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\CommandearticleArticleUtilisateurRepository;

#[ORM\Entity(repositoryClass: CommandearticleArticleUtilisateurRepository::class)]
class CommandearticleArticleUtilisateur
{
    #[ORM\Id]
    #[ORM\Column]
    #[ORM\ManyToMany(targetEntity: Utilisateur::class, mappedBy: 'iduser')]
    private ?int $idutilisateur;

    #[ORM\Id]
    #[ORM\Column]
    #[ORM\ManyToMany(targetEntity: Article::class, mappedBy: 'idarticle')]
    private ?int $idarticle;

    #[ORM\Id]
    #[ORM\Column]
    #[ORM\ManyToMany(targetEntity: Commandearticle::class, mappedBy: 'idcommade')]
    private ?int $idcommande;

    /*
    public function __construct($idu,$idc,ArrayCollection $ida)
    {
        $this->idutilisateur = $idu;
        $this->idarticle = $ida;
        $this->idcommande = $idc;
    }
    */


    public function getIdutilisateur(): ?int
    {
        return $this->idutilisateur;
    }


    public function setIdutilisateur(?int $idutilisateur): void
    {
        $this->idutilisateur = $idutilisateur;
    }


    public function getIdarticle(): ?int
    {
        return $this->idarticle;
    }


    public function setIdarticle(?int $idarticle): void
    {
        $this->idarticle = $idarticle;
    }


    public function getIdcommande(): ?int
    {
        return $this->idcommande;
    }


    public function setIdcommande(?int $idcommande): void
    {
        $this->idcommande = $idcommande;
    }

    public function addIdutilisateur(Utilisateur $idutilisateur): self
    {
        if (!$this->idutilisateur->contains($idutilisateur)) {
            $this->idutilisateur->add($idutilisateur);
            $idutilisateur->addIduser($this);
        }

        return $this;
    }

    public function removeIdutilisateur(Utilisateur $idutilisateur): self
    {
        if ($this->idutilisateur->removeElement($idutilisateur)) {
            $idutilisateur->removeIduser($this);
        }

        return $this;
    }

    public function addIdarticle(Article $idarticle): self
    {
        if (!$this->idarticle->contains($idarticle)) {
            $this->idarticle->add($idarticle);
            $idarticle->addIdarticle($this);
        }

        return $this;
    }

    public function removeIdarticle(Article $idarticle): self
    {
        if ($this->idarticle->removeElement($idarticle)) {
            $idarticle->removeIdarticle($this);
        }

        return $this;
    }

    public function addIdcommande(Commandearticle $idcommande): self
    {
        if (!$this->idcommande->contains($idcommande)) {
            $this->idcommande->add($idcommande);
            $idcommande->addIdcommade($this);
        }

        return $this;
    }

    public function removeIdcommande(Commandearticle $idcommande): self
    {
        if ($this->idcommande->removeElement($idcommande)) {
            $idcommande->removeIdcommade($this);
        }

        return $this;
    }



}
