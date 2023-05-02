<?php

namespace App\Entity;
use App\Entity\Artwork;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;
use App\Repository\StoreRepository;

#[ORM\Entity(repositoryClass:StoreRepository::class)]
class Store
{   
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'id_produit', type: 'integer')]
    private $id_produit;
    
    #[ORM\Column]
    private ?int $id_piece_art  = null;
  
    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Le nom de l\'artwork ne peut pas être vide.')]
    #[Assert\Length(max: 255, maxMessage: 'Le nom de l\'artwork ne peut pas dépasser {{ limit }} caractères.')]
    private ?string $nom_artwork = null;
   
    #[ORM\Column(type: 'float')]
    #[Assert\NotNull(message: 'Le prix de l\'artwork ne peut pas être vide.')]
    #[Assert\PositiveOrZero(message: 'Le prix de l\'artwork doit être positif ou nul.')]
    private ?float $prix_artwork = null;
    
    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'L\'image de l\'artwork ne peut pas être vide.')]
    #[Assert\Url(message: 'L\'image de l\'artwork doit être une URL valide.')]
    private ?string $img_artwork = null;
  
    #[ORM\ManyToOne(targetEntity: Artwork::class, inversedBy: 'stores')]
    #[ORM\JoinColumn(name: 'id_piece_art', referencedColumnName: 'id_artwork')]
    private $artwork;
  
 
    public function getIdProduit(): ?int
    {
        return $this->id_produit ;
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

    public function getPrixArtwork(): ?float
    {
        return $this->prix_artwork;
    }

    public function setPrixArtwork(float $prixArtwork): self
    {
        $this->prix_artwork = $prixArtwork;

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

    public function getIdPieceArt(): ?int
    {
        
        return $this->id_piece_art;
    }

    public function setIdPieceArt(int $idPieceArt): self
{
    $this->id_piece_art = $idPieceArt;
    
    return $this;
}

public function getArtwork(): ?Artwork
{
    return $this->artwork;
}
public function setArtwork(Artwork $artwork): self
{
    $this->artwork = $artwork;

    return $this;
}

}
