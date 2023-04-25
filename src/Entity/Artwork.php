<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Repository;
use App\Repository\ArtworkRepository;
use Symfony\Component\Validator\Constraints as Assert;
#[ORM\Entity(repositoryClass: ArtworkRepository::class)]
class Artwork
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id_artwork   = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"nom peut pas etre vide")]
    private ?string $nom_artwork	 = null;
   
    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"description peut pas etre vide")]
    private ?string $description_artwork = null;

    #[ORM\Column]
    #[Assert\NotBlank(message:"prix peut pas etre vide")]
    private ?int $prix_artwork = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Assert\NotBlank(message:"date peut pas etre vide")]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"lien peut pas etre vide")]
    private ?string $lien_artwork = null;
   
    #[ORM\Column]
    #[Assert\NotBlank(message:"dimension peut pas etre vide")]
    private ?int $dimension_artwork = null;
    #[ORM\Column]
    private ?int  $likesCount = 0;

    

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"image peut pas etre vide")]
    private ?string $img_artwork = null;

    #[ORM\ManyToOne(inversedBy: 'artworks')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $id_artist = null;

    #[ORM\ManyToOne(inversedBy: 'artworks')]
    private ?SousCat $id_type = null;
   
    // #[ORM\ManyToOne(targetEntity:"App\Entity\User", inversedBy: 'Artwork')]
    // #[ORM\JoinColumn(name: 'id_artist', referencedColumnName: 'id_user')]
    // #[ORM\ManyToOne(inversedBy: 'Artwork')]
    // #[ORM\JoinColumn(nullable: false)]
    // private ?User $id_artist = null;
   // private ?int $id_artist = null;
     //#[ORM\ManyToOne(targetEntity:"App\Entity\SousCat", inversedBy: 'Artwork')]
     //#[ORM\JoinColumn(name: 'id_type', referencedColumnName: 'id_sous_cat')]
   
    //private ?int $id_type  = null;
    // #[ORM\ManyToOne(inversedBy: 'Artwork')]
    // #[ORM\JoinColumn(nullable: false)]
    // private ?SousCat $id_type  = null;
    

    

    public function getLikesCount(): int
    {
        return $this->likesCount;
    }

    public function setLikesCount(int $likesCount): self
    {
        $this->likesCount = $likesCount;

        return $this;
    }


    public function getIdArtwork(): ?int
    {
        return $this->id_artwork ;
    }

    public function getNomArtwork(): ?string
    {
        return $this->nom_artwork;
    }

    public function setNomArtwork(string $nomArtwork): self
    {
        $this->nom_artwork = $nomArtwork;

        return $this;
    }

    public function getDescriptionArtwork(): ?string
    {
        return $this->description_artwork;
    }

    public function setDescriptionArtwork(string $descriptionArtwork): self
    {
        $this->description_artwork = $descriptionArtwork;

        return $this;
    }

    public function getPrixArtwork(): ?int
    {
        return $this->prix_artwork;
    }

    public function setPrixArtwork(int $prixArtwork): self
    {
        $this->prix_artwork = $prixArtwork;

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
        return $this->lien_artwork	;
    }

    public function setLienArtwork(string $lienArtwork): self
    {
        $this->lien_artwork	 = $lienArtwork;

        return $this;
    }

    public function getDimensionArtwork(): ?int
    {
        return $this->dimension_artwork;
    }

    public function setDimensionArtwork(int $dimensionArtwork): self
    {
        $this->dimension_artwork = $dimensionArtwork;

        return $this;
    }

    public function getImgArtwork(): ?string
    {
        return $this->img_artwork;
    }

    public function setImgArtwork(string $imgArtwork): self
    {
        $this->img_artwork = $imgArtwork;

        return $this;
    }

    public function getIdArtist(): ?User
    {
        return $this->id_artist ;
    }

    public function setIdArtist(?User $idArtist): self
    {
        $this->id_artist  = $idArtist;

        return $this;
    }

    public function getIdType(): ?SousCat
    {
        return $this->id_type ;
    }

    public function setIdType(?SousCat $idType): self
    {
        $this->id_type  = $idType;

        return $this;
    }


}
