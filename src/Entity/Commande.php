<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Artwork;
use Symfony\Component\OptionsResolver\Exception\InvalidArgumentException;
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
    #[ORM\JoinColumn(name: 'id_produit', referencedColumnName: 'id_artwork')]
  
    private ?object $id_produit = null;

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

    
    public function setIdProduit($idProduit): self
{
    if ($idProduit instanceof Artwork || $idProduit instanceof Store) {
        $this->id_produit = $idProduit;
    } else {
        throw new \InvalidArgumentException('Argument must be an instance of Artwork or Store');
    }

    return $this;
}

    
}
