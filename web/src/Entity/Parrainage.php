<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Parrainage
 *
 * @ORM\Table(name="parrainage", indexes={@ORM\Index(name="fk_id", columns={"id_user"})})
 * @ORM\Entity
 */
class Parrainage
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_parrainage", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idParrainage;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user", referencedColumnName="id_user")
     * })
     */
    private $idUser;

    

    
    public function getIdParrainage(): ?int
    {
        return $this->idParrainage;
    }

    public function getIdUser(): ?User
    {
        return $this->idUser;
    }

    public function setIdUser(?User $idUser): self
    {
        $this->idUser = $idUser;

        return $this;
    }

    


}
