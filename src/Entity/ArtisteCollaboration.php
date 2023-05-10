<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

use Repository;
use App\Repository\ArtisteCollaborationRepository;

#[ORM\Entity(repositoryClass: ArtisteCollaborationRepository::class)]
class ArtisteCollaboration
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id  = null;
    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_entree = null;

    #[ORM\Column]
    private ?int $id_collaboration_fk = null;

    #[ORM\Column]
    private ?int $id_artiste_fk = null;

    // #[ORM\ManyToOne(targetEntity: Collaboration::class, inversedBy: 'ArtisteCollaboration')]
    // #[ORM\JoinColumn(name: 'id_collaboration_fk', referencedColumnName: 'id_collaboration')]
    //#[ORM\Column]
  //  private ?int $id_collaboration_fk  = null;
    // #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'ArtisteCollaboration')]
    // #[ORM\JoinColumn(name: 'id_artiste_fk', referencedColumnName: 'id')]
   // #[ORM\Column]
    //private ?int $id_artiste_fk  = null;

    public function getDateEntree(): ?\DateTimeInterface
    {
        return $this->date_entree;
    }

    public function setDateEntree(\DateTimeInterface $dateEntree): self
    {
        $this->date_entree = $dateEntree;

        return $this;
    }

    public function getIdCollaborationFk(): ?int
    {
        return $this->id_collaboration_fk;
    }

    public function setIdCollaborationFk(?int $idCollaborationFk): self
    {
        $this->id_collaboration_fk = $idCollaborationFk;

        return $this;
    }

    public function getIdArtisteFk(): ?int
    {
        return $this->id_artiste_fk;
    }

    public function setIdArtisteFk(?int $idArtisteFk): self
    {
        $this->id_artiste_fk = $idArtisteFk;

        return $this;
    }


}
