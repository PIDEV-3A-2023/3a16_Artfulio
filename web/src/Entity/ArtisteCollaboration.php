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

    #[ORM\ManyToOne(targetEntity: Collaboration::class, inversedBy: 'ArtisteCollaboration')]
    #[ORM\JoinColumn(name: 'id_collaboration_fk', referencedColumnName: 'id_collaboration')]

    private ?int $id_collaboration_fk  = null;
    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'ArtisteCollaboration')]
    #[ORM\JoinColumn(name: 'id_artiste_fk', referencedColumnName: 'id')]

    private ?int $id_artiste_fk  = null;

    public function getDateEntree(): ?\DateTimeInterface
    {
        return $this->date_entree;
    }

    public function setDateEntree(\DateTimeInterface $dateEntree): self
    {
        $this->date_entree = $dateEntree;

        return $this;
    }

    public function getIdCollaborationFk(): ?Collaboration
    {
        return $this->id_collaboration_fk;
    }

    public function setIdCollaborationFk(?Collaboration $idCollaborationFk): self
    {
        $this->id_collaboration_fk = $id_collaboration_fk;

        return $this;
    }

    public function getIdArtisteFk(): ?User
    {
        return $this->id_artiste_fk;
    }

    public function setIdArtisteFk(?User $idArtisteFk): self
    {
        $this->id_artiste_fk = $idArtisteFk;

        return $this;
    }


}
