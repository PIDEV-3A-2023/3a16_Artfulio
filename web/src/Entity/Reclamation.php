<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Reclamation
 *
 * @ORM\Table(name="reclamation", indexes={@ORM\Index(name="id_user", columns={"id_user"})})
 * @ORM\Entity
 */
class Reclamation
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_rec", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idRec;

    /**
     * @var string
     *
     * @ORM\Column(name="Titre", type="string", length=50, nullable=false)
     * * @Assert\NotBlank(message="Titre doit être non vide")
     * * @Assert\Length(
     *      min = 10,
     *      max = 50,
     *      minMessage = "doit etre >=10 ",
     *      maxMessage = "doit etre <=50" )
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="Reclamation_sec", type="string", length=2000, nullable=false)
     * @Assert\NotBlank(message="Section doit être non vide")
     * * @Assert\Length(
     *      min = 100,
     *      max = 1000,
     *      minMessage = "doit etre >=100 ",
     *      maxMessage = "doit etre <=1000" )
     */
    private $reclamationSec;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=30, nullable=false)
     * @Assert\NotBlank(message="Email doit être non vide")
     * * @Assert\Email(
     *     message = "Email non valide.",
     * )
     */
    private $email;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user", referencedColumnName="id_user")
     * })
     */
    private $idUser;

    public function getIdRec(): ?int
    {
        return $this->idRec;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getReclamationSec(): ?string
    {
        return $this->reclamationSec;
    }

    public function setReclamationSec(string $reclamationSec): self
    {
        $this->reclamationSec = $reclamationSec;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
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
