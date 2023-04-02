<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

use Repository;
use App\Repository\StoreRepository;

#[ORM\Entity(repositoryClass:StoreRepository::class)]
class Store
{#[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id_produit   = null;
  
    #[ORM\Column(length: 255)]
    private ?string $nom_artwork = null;
   
 
    #[ORM\Column]
    private ?float $prix_artwork = null;
    

    #[ORM\Column(length: 255)]
    private ?string $img_artwork = null;
  
    #[ORM\ManyToOne(targetEntity: Artwork::class, inversedBy: 'Store')]
    #[ORM\JoinColumn(name: 'id_piece_art', referencedColumnName: 'id_artwork')]
    private ?int $id_piece_art  = null;
 
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

    public function getIdPieceArt(): ?Artwork
    {
        return $this->id_piece_art ;
    }

    public function setIdPieceArt(?Artwork $idPieceArt): self
    {
        $this->id_piece_art  = $idPieceArt;

        return $this;
    }


}
