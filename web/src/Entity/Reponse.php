<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reponse
 *
 * @ORM\Table(name="reponse", indexes={@ORM\Index(name="fk_id_reclamation", columns={"fk_id_reclamation"}), @ORM\Index(name="fk_id_admin", columns={"fk_id_admin"})})
 * @ORM\Entity
 */
class Reponse
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_reponse", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idReponse;

    /**
     * @var string
     *
     * @ORM\Column(name="message_rep", type="string", length=255, nullable=false)
     */
    private $messageRep;

    /**
     * @var \Reclamation
     *
     * @ORM\ManyToOne(targetEntity="Reclamation")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fk_id_reclamation", referencedColumnName="id_reclamation")
     * })
     */
    private $fkIdReclamation;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fk_id_admin", referencedColumnName="id")
     * })
     */
    private $fkIdAdmin;

    public function getIdReponse(): ?int
    {
        return $this->idReponse;
    }

    public function getMessageRep(): ?string
    {
        return $this->messageRep;
    }

    public function setMessageRep(string $messageRep): self
    {
        $this->messageRep = $messageRep;

        return $this;
    }

    public function getFkIdReclamation(): ?Reclamation
    {
        return $this->fkIdReclamation;
    }

    public function setFkIdReclamation(?Reclamation $fkIdReclamation): self
    {
        $this->fkIdReclamation = $fkIdReclamation;

        return $this;
    }

    public function getFkIdAdmin(): ?User
    {
        return $this->fkIdAdmin;
    }

    public function setFkIdAdmin(?User $fkIdAdmin): self
    {
        $this->fkIdAdmin = $fkIdAdmin;

        return $this;
    }


}
