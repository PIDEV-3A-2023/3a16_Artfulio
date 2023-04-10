<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

use Repository;
use App\Repository\CommandeRepository;

#[ORM\Entity(repositoryClass: CommandeRepository::class)]
class Commande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $Id_Vente    = null;
   
    #[ORM\Column]
    private ?float $prixArtwork = null;

    #[ORM\Column(length: 255)]
    private ?string $paiement = null;
    #[ORM\ManyToOne(targetEntity: Artwork::class, inversedBy: 'Commande')]
    #[ORM\JoinColumn(name: 'id_produit', referencedColumnName: 'id')]
  
    private  ?int $id_produit    = null;

    public function getIdVente(): ?int
    {
        return $this->Id_Vente;
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

    public function getPaiement(): ?string
    {
        return $this->paiement;
    }

    public function setPaiement(string $paiement): self
    {
        $this->paiement = $paiement;

        return $this;
    }

    public function getIdProduit(): ?Artwork
    {
        return $this->id_produit;
    }

    public function setIdProduit(?Artwork $idProduit): self
    {
        $this->id_produit = $idProduit;

        return $this;
    }


}
