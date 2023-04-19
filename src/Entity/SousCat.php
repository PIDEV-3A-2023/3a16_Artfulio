<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SousCat
 *
 * @ORM\Table(name="sous_cat", indexes={@ORM\Index(name="fk_type", columns={"nom_sous_cat"}), @ORM\Index(name="fk_id_categorie", columns={"id_categorie"}), @ORM\Index(name="type_sous_cat", columns={"type_sous_cat"})})
 * @ORM\Entity
 */
class SousCat
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_sous_cat", type="string", length=255, nullable=false)
     */
    private $nomSousCat;

    /**
     * @var string
     *
     * @ORM\Column(name="type_sous_cat", type="string", length=255, nullable=false)
     */
    private $typeSousCat;

    /**
     * @var int
     *
     * @ORM\Column(name="id_categorie", type="integer", nullable=false)
     */
    private $idCategorie;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomSousCat(): ?string
    {
        return $this->nomSousCat;
    }

    public function setNomSousCat(string $nomSousCat): self
    {
        $this->nomSousCat = $nomSousCat;

        return $this;
    }

    public function getTypeSousCat(): ?string
    {
        return $this->typeSousCat;
    }

    public function setTypeSousCat(string $typeSousCat): self
    {
        $this->typeSousCat = $typeSousCat;

        return $this;
    }

    public function getIdCategorie(): ?int
    {
        return $this->idCategorie;
    }

    public function setIdCategorie(int $idCategorie): self
    {
        $this->idCategorie = $idCategorie;

        return $this;
    }


}
