<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Categorie
 *
 * @ORM\Table(name="categorie")
 * @ORM\Entity
 * @UniqueEntity(fields={"typeCategorie"}, message="Type doit être unique")
 */
class Categorie
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_categorie", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCategorie;

    /**
     * @var string
     *
     * @ORM\Column(name="type_categorie", type="string", length=255, nullable=false)
     * @Assert\NotBlank(message="Type doit être non vide")
     * 
     */

   
    private $typeCategorie;

    public function getIdCategorie(): ?int
    {
        return $this->idCategorie;
    }

    public function getTypeCategorie(): ?string
    {
        return $this->typeCategorie;
    }

    public function setTypeCategorie(string $typeCategorie): self
    {
        $this->typeCategorie = $typeCategorie;

        return $this;
    }


    public function __toString()
    {
        return(string) $this->getIdCategorie();

    }




    
}
