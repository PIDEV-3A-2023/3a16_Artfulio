<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Repository;
use App\Repository\CategorieRepository;

#[ORM\Entity(repositoryClass: CategorieRepository::class)]
class Categorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id_categorie  = null;
  
 #[ORM\Column(length: 255)]
    private ?string $type_categorie = null;
  

    #[ORM\Column(length: 255)]
    private ?string $nom_categorie = null;
  

    public function getIdCategorie(): ?int
    {
        return $this->id_categorie;
    }

    public function getTypeCategorie(): ?string
    {
        return $this->type_categorie;
    }

    public function setTypeCategorie(string $typeCategorie): self
    {
        $this->type_categorie = $typeCategorie;

        return $this;
    }

    public function getNomCategorie(): ?string
    {
        return $this->nom_categorie;
    }

    public function setNomCategorie(string $nomCategorie): self
    {
        $this->nom_categorie = $nomCategorie;

        return $this;
    }


}
