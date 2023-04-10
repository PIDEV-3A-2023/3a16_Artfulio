<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * ArtisteCollaboration
 *
 * @ORM\Table(name="artiste_collaboration")
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
     * @var int
     *
     * @ORM\Column(name="id_artiste_fk", type="integer", nullable=false)
     */
    private $idArtisteFk;

    /**
     * @var int
     *
     * @ORM\Column(name="id_collaboration_fk", type="integer", nullable=false)
     */
    private $idCollaborationFk;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_entree", type="date", nullable=false)
     */
    private $dateEntree;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdArtisteFk(): ?int
    {
        return $this->idArtisteFk;
    }

    public function setIdArtisteFk(int $idArtisteFk): self
    {
        $this->idArtisteFk = $idArtisteFk;

        return $this;
    }

    public function getIdCollaborationFk(): ?int
    {
        return $this->idCollaborationFk;
    }

    public function setIdCollaborationFk(int $idCollaborationFk): self
    {
        $this->idCollaborationFk = $idCollaborationFk;

        return $this;
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


}
