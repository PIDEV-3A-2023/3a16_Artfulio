<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Repository;
use App\Repository\ReclamationRepository;

#[ORM\Entity(repositoryClass: ReclamationRepository::class)]
class Reclamation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id_rec   = null;
   

   
    #[ORM\Column]
    private ?int $id_user  = null;
   

    #[ORM\Column(length: 255)]
    private ?string $titre = null;
  
    #[ORM\Column(length: 255)]
    private ?string $Reclamation_sec = null;
  

  

    #[ORM\Column(length: 255)]
    private ?string $email = null;
  
  

    public function getIdRec(): ?int
    {
        return $this->id_rec ;
    }

    public function getIdUser(): ?int
    {
        return $this->id_user ;
    }

    public function setIdUser(int $idUser): self
    {
        $this->id_user  = $idUser;

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

    public function getReclamationSec(): ?string
    {
        return $this->Reclamation_sec;
    }

    public function setReclamationSec(string $reclamationSec): self
    {
        $this->Reclamation_sec = $reclamationSec;

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


}
