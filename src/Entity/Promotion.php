<?php

namespace App\Entity;

use App\Repository\PromotionRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Artwork;


#[ORM\Entity(repositoryClass: PromotionRepository::class)]
class Promotion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $remise = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\ManyToOne(inversedBy: 'promotions')]
    #[ORM\JoinColumn(name: 'id_artwork', referencedColumnName: 'id_artwork')]
    private ?Artwork $id_artwork = null;

    #[ORM\Column(length: 255)]
    private ?string $nom_artwork = null;

    #[ORM\Column(length: 255)]
    private ?string $prix_artwork = null;

    public function getId(): ?int
    {
        return $this->id;
    }
   

    public function getRemise(): ?int
    {
        return $this->remise;
    }

    public function setRemise(int $remise): self
    {
        $this->remise = $remise;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getidArtwork(): ?Artwork
    {
        return $this->id_artwork;
    }
    
    public function getnomArtwork(): ?string
    {
        return $this->nom_artwork;
    }
  

    public function setArtwork(?Artwork $artwork): self
    {
        $this->id_artwork = $artwork;

        return $this;
    }

    public function setNomArtwork(string $nomArtwork): self
    {
        $this->nom_artwork = $nomArtwork;

        return $this;
    }

    public function getPrix(): ?string
    {
        return $this->prix_artwork;
    }

    public function setPrix(string $prix): self
    {
        $this->prix_artwork = $prix;

        return $this;
    }
}