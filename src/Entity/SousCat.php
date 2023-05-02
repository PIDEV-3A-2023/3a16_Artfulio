<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SousCat
 *
 * @ORM\Table(name="sous_cat")
 * @ORM\Entity
 */
class SousCat
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_sous_cat", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idSousCat;

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

    public function getIdSousCat(): ?int
    {
        return $this->idSousCat;
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
