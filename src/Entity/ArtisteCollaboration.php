<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * ArtisteCollaboration
 *
 * @ORM\Table(name="artiste_collaboration", indexes={@ORM\Index(name="IDX_DF84342A1BB81041", columns={"id_collaboration_fk"}), @ORM\Index(name="IDX_DF84342A937FD9CD", columns={"id_artiste_fk"})})
 * @ORM\Entity
 */
class ArtisteCollaboration
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
     * @var \DateTime
     *
     * @ORM\Column(name="date_entree", type="date", nullable=false)
     */
    private $dateEntree;

    /**
     * @var \Collaboration
     *
     * @ORM\ManyToOne(targetEntity="Collaboration")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_collaboration_fk", referencedColumnName="id_collaboration")
     * })
     */
    private $idCollaborationFk;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_artiste_fk", referencedColumnName="id_user")
     * })
     */
    private $idArtisteFk;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateEntree(): ?\DateTimeInterface
    {
        return $this->dateEntree;
    }

    public function setDateEntree(\DateTimeInterface $dateEntree): self
    {
        $this->dateEntree = $dateEntree;

        return $this;
    }

    public function getIdCollaborationFk(): ?Collaboration
    {
        return $this->idCollaborationFk;
    }

    public function setIdCollaborationFk(?Collaboration $idCollaborationFk): self
    {
        $this->idCollaborationFk = $idCollaborationFk;

        return $this;
    }

    public function getIdArtisteFk(): ?User
    {
        return $this->idArtisteFk;
    }

    public function setIdArtisteFk(?User $idArtisteFk): self
    {
        $this->idArtisteFk = $idArtisteFk;

        return $this;
    }


}
