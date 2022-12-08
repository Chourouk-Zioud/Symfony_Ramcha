<?php

namespace App\Entity;

use App\Repository\LogRepository;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints as Assert;
use function Symfony\Component\Translation\t;


#[ORM\Entity(repositoryClass: LogRepository::class)]
class Log
{


    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank (message: "Veuillez entrer votre Email !")]
    #[Assert\Email(message: "Email '{{ value }}' n'est pas valide")]
    private ?string $login = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank (message: 'veuillez entrer votre mot de passe !')]
    #[Assert\Length(min: 8, minMessage: "Votre mot de passe doit contenir minimum 8 cartères ")]
    private ?string $passw = null;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): self
    {
        $this->login = $login;

        return $this;
    }

    public function getPassw(): ?string
    {
        return $this->passw;
    }

    public function setPassw(string $passw): self
    {
        $this->passw = $passw;

        return $this;
    }


}
