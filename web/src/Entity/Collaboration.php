<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

use Repository;
use App\Repository\CollaborationRepository;

#[ORM\Entity(repositoryClass: CollaborationRepository::class)]
class Collaboration
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id_collaboration   = null;

    #[ORM\Column(length: 255)]
    private ?string $type_collaboration = null;


    #[ORM\Column(length: 255)]
    private ?string $titre = null;
   

    #[ORM\Column(length: 255)]
    private ?string $description = null;
    
    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_sortie = null;
   

    #[ORM\Column(length: 255)]
    private ?string $status = null;

    #[ORM\Column(length: 255)]
    private ?string $nom_user = null;


    #[ORM\Column(length: 255)]
    private ?string $email_user = null;

   
    public function getIdCollaboration(): ?int
    {
        return $this->id_collaboration ;
    }

    public function getTypeCollaboration(): ?string
    {
        return $this->type_collaboration;
    }

    public function setTypeCollaboration(string $typeCollaboration): self
    {
        $this->type_collaboration = $typeCollaboration;

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
        return $this->date_sortie;
    }

    public function setDateSortie(\DateTimeInterface $dateSortie): self
    {
        $this->date_sortie = $dateSortie;

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
        return $this->nom_user;
    }

    public function setNomUser(string $nomUser): self
    {
        $this->nom_user = $nomUser;

        return $this;
    }

    public function getEmailUser(): ?string
    {
        return $this->email_user;
    }

    public function setEmailUser(string $emailUser): self
    {
        $this->email_user = $emailUser;

        return $this;
    }


}
