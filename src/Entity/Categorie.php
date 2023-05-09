<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\CategorieRepository;

#[ORM\Table(name: "categorie")]
#[ORM\Entity(repositoryClass: CategorieRepository::class)]
class Categorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id  = null;
  
    #[ORM\Column(length: 255)]
    private ?string $type_categorie = null;
  

    #[ORM\Column(length: 255)]
    private ?string $nom_categorie = null;
  

    public function getIdCategorie(): ?int
    {
        return $this->id;
    }
    public function getId_Categorie(): ?int
    {
        return $this->id;
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
    public function setIdCategorie($id): self
    {
        $this->id = $id;

        return $this;
    }
}