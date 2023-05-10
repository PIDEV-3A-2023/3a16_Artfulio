<?php

namespace App\Entity;

use App\Repository\CollaborationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CollaborationRepository::class)]
class Collaboration
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private ?int $idCollaboration = null;

    #[ORM\Column(type: "string", length: 50)]
    private ?string $typeCollaboration = null;

    #[ORM\Column(type: "string", length: 50)]
    private ?string $titre = null;

    #[ORM\Column(type: "string", length: 300)]
    private ?string $description = null;

    #[ORM\Column(type: "date")]
    private ?\DateTimeInterface $dateSortie = null;

    #[ORM\Column(type: "string", length: 20)]
    private ?string $status = null;

    #[ORM\Column(type: "string", length: 50)]
    private ?string $nomUser = null;

    #[ORM\Column(type: "string", length: 50)]
    private ?string $emailUser = null;

    public function getIdCollaboration(): ?int
    {
        return $this->idCollaboration;
    }

    public function getTypeCollaboration(): ?string
    {
        return $this->typeCollaboration;
    }

    public function setTypeCollaboration(string $typeCollaboration): self
    {
        $this->typeCollaboration = $typeCollaboration;

        return $this;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDateSortie(): ?\DateTimeInterface
    {
        return $this->dateSortie;
    }

    public function setDateSortie(\DateTimeInterface $dateSortie): self
    {
        $this->dateSortie = $dateSortie;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getNomUser(): ?string
    {
        return $this->nomUser;
    }

    public function setNomUser(string $nomUser): self
    {
        $this->nomUser = $nomUser;

        return $this;
    }

    public function getEmailUser(): ?string
    {
        return $this->emailUser;
    }

    public function setEmailUser(string $emailUser): self
    {
        $this->emailUser = $emailUser;

        return $this;
    }
}
