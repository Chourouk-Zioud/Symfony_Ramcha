<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\CommandeserviceServiceUtilisateurRepository;


#[ORM\Entity(repositoryClass: CommandeserviceServiceUtilisateurRepository::class)]

class CommandeserviceServiceUtilisateur
{
    #[ORM\Id]
    #[ORM\Column]
    #[ORM\ManyToMany(targetEntity: Service::class, mappedBy: 'idcommandeservice')]
    private $idcommandeservice;

    #[ORM\Id]
    #[ORM\Column]
    #[ORM\ManyToMany(targetEntity: Service::class, mappedBy: 'idservice')]
    private $idservice;

    #[ORM\Id]
    #[ORM\Column]
    #[ORM\ManyToMany(targetEntity: Utilisateur::class, mappedBy: 'iduser')]
    private $idutilisateur;


    public function setIdcommandeservice($idcommandeservice): void
    {
        $this->idcommandeservice = $idcommandeservice;
    }


    public function setIdservice($idservice): void
    {
        $this->idservice = $idservice;
    }


    public function setIdutilisateur($idutilisateur): void
    {
        $this->idutilisateur = $idutilisateur;
    }

    /*
    public function __construct()
    {
        $this->idcommandeservice = new ArrayCollection();
        $this->idservice = new ArrayCollection();
        $this->idutilisateur = new ArrayCollection();
    }
*/



    public function getIdcommandeservice()
    {
        return $this->idcommandeservice;
    }

    public function addIdcommandeservice(Service $idcommandeservice): self
    {
        if (!$this->idcommandeservice->contains($idcommandeservice)) {
            $this->idcommandeservice->add($idcommandeservice);
            $idcommandeservice->addIdcommandeservice($this);
        }

        return $this;
    }

    public function removeIdcommandeservice(Service $idcommandeservice): self
    {
        if ($this->idcommandeservice->removeElement($idcommandeservice)) {
            $idcommandeservice->removeIdcommandeservice($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Service>
     */
    public function getIdservice()
    {
        return $this->idservice;
    }

    public function addIdservice(Service $idservice): self
    {
        if (!$this->idservice->contains($idservice)) {
            $this->idservice->add($idservice);
            $idservice->addIdservice($this);
        }

        return $this;
    }

    public function removeIdservice(Service $idservice): self
    {
        if ($this->idservice->removeElement($idservice)) {
            $idservice->removeIdservice($this);
        }

        return $this;
    }


    public function getIdutilisateur()
    {
        return $this->idutilisateur;
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


}
