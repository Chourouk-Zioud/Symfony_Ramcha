<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ArticleRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

#[ORM\Entity(repositoryClass: ArticleRepository::class)]
#[Vich\Uploadable]
class Article
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: "idArticle")]
    private ?int $idarticle = null;

    #[Vich\UploadableField(mapping: 'art', fileNameProperty: 'imageName')]
    private ?File $imageFile = null;

    #[ORM\Column(name: "image_name",length: 255)]
    private ?string  $imageName = null;

    #[ORM\Column(name: "nomArticle",length: 255)]
    #[Assert\Length(
    min : 3,
    max :10,
    minMessage :" Le nom d'un article comporte au moins {{ limit }} caractères",
    maxMessage:"Le nom d'un article doit comporter au plus {{ limit }} caractères")]

    #[Assert\NotBlank(message: "Name is required")]
    private ?string  $nomarticle = null;

    #[ORM\Column(name: "marqueArticle",length: 255)]
    #[Assert\Length(
        min : 3,
        max :10,
        minMessage :" marque article comporte au moins {{ limit }} caractères",
        maxMessage:"marque article doit comporter au plus {{ limit }} caractères")]
    #[Assert\NotBlank(message: "marque article is required")]
    private ?string  $marquearticle = null;

    #[ORM\Column(name: "typeArticle",length: 255)]
    #[Assert\Length(
        min : 3,
        max :15,
        minMessage :" type article comporte au moins {{ limit }} caractères",
        maxMessage:"type article doit comporter au plus {{ limit }} caractères")]
    #[Assert\NotBlank(message: "type article is required")]
    private ?string  $typearticle = null;

    #[ORM\Column(name: "disponibiliteArticle",length: 255)]
    #[Assert\Length(
        min : 3,
        max :10,
        minMessage :" disponibilite article comporte au moins {{ limit }} caractères",
        maxMessage:"disponibilite article doit comporter au plus {{ limit }} caractères")]
    #[Assert\NotBlank(message: "disponibilite article is required")]
    private ?string  $disponibilitearticle = null;

    #[ORM\Column(name: "couleurArticle",length: 255)]
    #[Assert\NotBlank(message: "couleur article is required")]
    private ?string $couleurarticle = null;

    #[ORM\Column(name: "prixArticle")]
    #[Assert\NotBlank(message: "prix article is required")]
    private ?float $prixarticle = null;

    #[ORM\Column(name: "tailleArticle",length: 255)]
    #[Assert\NotBlank(message: "taille article is required")]
    private ?string $taillearticle = null;

    #[ORM\Column(name: "descriptionArticle",length: 255)]
    #[Assert\Length(
        min : 5,
        max :100,
        minMessage :" description article comporte au moins {{ limit }} caractères",
        maxMessage:"description article doit comporter au plus {{ limit }} caractères")]
    #[Assert\NotBlank(message: "description article is required")]
    private ?string $descriptionarticle = null;

    //#[ORM\Column(name: "screenshot",length: 255)]
    //#[Assert\NotBlank(message: "Image article is required")]
    //private ?string $screenshot = null;

    #[ORM\Column(name: "IdidMagasin")]
    private ?int $ididmagasin = null;

    #[ORM\Column(name: "idCategorieArticle")]
    private ?int $idcategoriearticle = null;

    #[ORM\Column(name: "note")]
    private ?int $note = null;

    /**
     * @return int|null
     */
    public function getNote(): ?int
    {
        return $this->note;
    }

    /**
     * @param int|null $note
     */
    public function setNote(?int $note): void
    {
        $this->note = $note;
    }

    public function getIdarticle(): ?int
    {
        return $this->idarticle;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function setImageName(?string $imageName): self
    {
        $this->imageName = $imageName;

        return $this;
    }

    public function getNomarticle(): ?string
    {
        return $this->nomarticle;
    }

    public function setNomarticle(string $nomarticle): self
    {
        $this->nomarticle = $nomarticle;

        return $this;
    }

    public function getMarquearticle(): ?string
    {
        return $this->marquearticle;
    }

    public function setMarquearticle(string $marquearticle): self
    {
        $this->marquearticle = $marquearticle;

        return $this;
    }

    public function getTypearticle(): ?string
    {
        return $this->typearticle;
    }

    public function setTypearticle(string $typearticle): self
    {
        $this->typearticle = $typearticle;

        return $this;
    }

    public function getDisponibilitearticle(): ?string
    {
        return $this->disponibilitearticle;
    }

    public function setDisponibilitearticle(string $disponibilitearticle): self
    {
        $this->disponibilitearticle = $disponibilitearticle;

        return $this;
    }

    public function getCouleurarticle(): ?string
    {
        return $this->couleurarticle;
    }

    public function setCouleurarticle(string $couleurarticle): self
    {
        $this->couleurarticle = $couleurarticle;

        return $this;
    }

    public function getPrixarticle(): ?float
    {
        return $this->prixarticle;
    }

    public function setPrixarticle(float $prixarticle): self
    {
        $this->prixarticle = $prixarticle;

        return $this;
    }

    public function getTaillearticle(): ?string
    {
        return $this->taillearticle;
    }

    public function setTaillearticle(string $taillearticle): self
    {
        $this->taillearticle = $taillearticle;

        return $this;
    }

    public function getDescriptionarticle(): ?string
    {
        return $this->descriptionarticle;
    }

    public function setDescriptionarticle(string $descriptionarticle): self
    {
        $this->descriptionarticle = $descriptionarticle;

        return $this;
    }



    public function getIdidmagasin(): ?int
    {
        return $this->ididmagasin;
    }

    public function setIdidmagasin(int $ididmagasin): self
    {
        $this->ididmagasin = $ididmagasin;

        return $this;
    }

    public function getIdcategoriearticle(): ?int
    {
        return $this->idcategoriearticle;
    }

    public function setIdcategoriearticle(int $idcategoriearticle): self
    {
        $this->idcategoriearticle = $idcategoriearticle;

        return $this;
    }

    /**
     * @param  File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $imageFile
     */

    public function setImageFile( $imageFile = null): void
    {
        $this->imageFile = $imageFile;

    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

}

