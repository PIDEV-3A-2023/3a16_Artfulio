<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: "artwork")]
#[ORM\Index(name: "nom_artwork", columns: ["nom_artwork"])]
#[ORM\Index(name: "prix_artwork", columns: ["prix_artwork"])]
#[ORM\Entity]
class Artwork
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private $id_artwork;

    #[ORM\Column(type: "string", length: 255)]
    private $nomArtwork;

    #[ORM\Column(type: "string", length: 255)]
    private $descriptionArtwork;

    #[ORM\Column(type: "integer")]
    private $prixArtwork;

    #[ORM\Column(type: "date")]
    private $date;

    #[ORM\Column(type: "string", length: 255)]
    private $lienArtwork;

    #[ORM\Column(type: "integer")]
    private $dimensionArtwork;

   /*  public function getIdArtwork(): ?int
    {
        return $this->id_artwork;
    }
 */

    public function getNomArtwork(): ?string
    {
        return $this->nomArtwork;
    }

    public function setNomArtwork(string $nomArtwork): self
    {
        $this->nomArtwork = $nomArtwork;

        return $this;
    }

    public function getDescriptionArtwork(): ?string
    {
        return $this->descriptionArtwork;
    }

    public function setDescriptionArtwork(string $descriptionArtwork): self
    {
        $this->descriptionArtwork = $descriptionArtwork;

        return $this;
    }

    public function getPrixArtwork(): ?int
    {
        return $this->prixArtwork;
    }

    public function setPrixArtwork(int $prixArtwork): self
    {
        $this->prixArtwork = $prixArtwork;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getLienArtwork(): ?string
    {
        return $this->lienArtwork;
    }

    public function setLienArtwork(string $lienArtwork): self
    {
        $this->lienArtwork = $lienArtwork;

        return $this;
    }

    public function getDimensionArtwork(): ?int
    {
        return $this->dimensionArtwork;
    }

    public function setDimensionArtwork(int $dimensionArtwork): self
    {
        $this->dimensionArtwork = $dimensionArtwork;

        return $this;
    }

    public function getImgArtwork(): ?string
    {
        return $this->imgArtwork;
    }

    public function setImgArtwork(string $imgArtwork): self
    {
        $this->imgArtwork = $imgArtwork;

        return $this;
    }

    public function getIdArtwork(): ?int
    {
        return $this->id_artwork;
    }


}
