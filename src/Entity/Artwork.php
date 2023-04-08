<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Artwork
 *
 * @ORM\Table(name="artwork")
 * @ORM\Entity
 */
class Artwork
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_artwork", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idArtwork;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_artwork", type="string", length=255, nullable=false)
     */
    private $nomArtwork;

    /**
     * @var string
     *
     * @ORM\Column(name="description_artwork", type="string", length=255, nullable=false)
     */
    private $descriptionArtwork;

    /**
     * @var int
     *
     * @ORM\Column(name="prix_artwork", type="integer", nullable=false)
     */
    private $prixArtwork;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=false)
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="lien_artwork", type="string", length=255, nullable=false)
     */
    private $lienArtwork;

    /**
     * @var int
     *
     * @ORM\Column(name="dimension_artwork", type="integer", nullable=false)
     */
    private $dimensionArtwork;

    /**
     * @var string
     *
     * @ORM\Column(name="img_artwork", type="string", length=255, nullable=false)
     */
    private $imgArtwork;

    public function getIdArtwork(): ?int
    {
        return $this->idArtwork;
    }

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


}
