<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

use Repository;
use App\Repository\ParrainageRepository;

#[ORM\Entity(repositoryClass: ParrainageRepository::class)]
class Parrainage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id_parrainage  = null;
    // #[ORM\Column(length: 255)]
    // private ?string $email = null;

    // #[ORM\Column(length: 255)]
    // private ?string $username = null;
    

    // #[ORM\Column]
    // private ?int $is_pro  = null;
   

    // #[ORM\Column(length: 255)]
    // private ?string $type_role  = null;

    #[ORM\ManyToOne(inversedBy: 'parrainages')]
    private ?Artist $idUser = null;
  

    public function getIdParrainage(): ?int
    {
        return $this->id_parrainage ;
    }

    // public function getEmail(): ?string
    // {
    //     return $this->email;
    // }

    // public function setEmail(string $email): self
    // {
    //     $this->email = $email;

    //     return $this;
    // }

    // public function getUsername(): ?string
    // {
    //     return $this->username;
    // }

    // public function setUsername(string $username): self
    // {
    //     $this->username = $username;

    //     return $this;
    // }

    // public function getIsPro(): ?int
    // {
    //     return $this->is_pro ;
    // }

    // public function setIsPro(int $isPro): self
    // {
    //     $this->is_pro  = $isPro;

    //     return $this;
    // }

    // public function getTypeRole(): ?string
    // {
    //     return $this->type_role ;
    // }

    // public function setTypeRole(string $typeRole): self
    // {
    //     $this->type_role  = $typeRole;

    //     return $this;
    // }

    public function getIdUser(): ?Artist
    {
        return $this->idUser;
    }

    public function setIdUser(?Artist $idUser): self
    {
        $this->idUser = $idUser;

        return $this;
    }


}
