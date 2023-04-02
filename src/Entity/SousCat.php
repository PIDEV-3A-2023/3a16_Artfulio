<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

use Repository;
use App\Repository\SousCatRepository;

#[ORM\Entity(repositoryClass: SousCatRepository::class)]
class SousCat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id_sous_cat   = null;


    #[ORM\Column(length: 255)]
    private ?string $type_sous_cat  = null;
   

    #[ORM\Column]
    private ?int $id_categorie  = null;
 
    #[ORM\ManyToOne(targetEntity: Categorie::class, inversedBy: 'SousCat')]
    #[ORM\JoinColumn(name: 'nom_sous_cat', referencedColumnName: 'nom_categorie')]

   

    public function getIdSousCat(): ?int
    {
        return $this->id_sous_cat ;
    }

    public function getTypeSousCat(): ?string
    {
        return $this->type_sous_cat ;
    }

    public function setTypeSousCat(string $typeSousCat): self
    {
        $this->type_sous_cat  = $typeSousCat;

        return $this;
    }

    public function getIdCategorie(): ?int
    {
        return $this->id_categorie ;
    }

    public function setIdCategorie(int $idCategorie): self
    {
        $this->id_categorie  = $idCategorie;

        return $this;
    }

    public function getNomSousCat(): ?Categorie
    {
        return $this->nom_sous_cat ;
    }

    public function setNomSousCat(?Categorie $nomSousCat): self
    {
        $this->nom_sous_cat  = $nomSousCat;

        return $this;
    }


}
