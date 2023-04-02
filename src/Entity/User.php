<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

use Repository;
use App\Repository\UserRepository;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id_user    = null;
    #[ORM\Column(length: 255)]
    private ?string $username = null;
 
    #[ORM\Column(length: 255)]
    private ?string $cin_user = null;
 

    #[ORM\Column(length: 255)]
    private ?string $adresse_user = null;
 
  
    #[ORM\Column(length: 255)]
    private ?string $password_user = null;
 
  
    #[ORM\Column(length: 255)]
    private ?string $email_user  = null;
 
  
    #[ORM\Column]
    private ?bool $is_pro  = false;

    

    #[ORM\Column(length: 255)]
    private ?string $img_user	 = null;

    #[ORM\ManyToOne(targetEntity: Role::class, inversedBy: 'User')]
    #[ORM\JoinColumn(name: 'type_role', referencedColumnName: 'type_role')]
    
    private ?string $type_role  = null;

    public function getIdUser(): ?int
    {
        return $this->id_user ;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getCinUser(): ?string
    {
        return $this->cin_user	;
    }

    public function setCinUser(string $cinUser): self
    {
        $this->cin_user	 = $cinUser;

        return $this;
    }

    public function getAdresseUser(): ?string
    {
        return $this->adresse_user;
    }

    public function setAdresseUser(string $adresseUser): self
    {
        $this->adresse_user = $adresseUser;

        return $this;
    }

    public function getPasswordUser(): ?string
    {
        return $this->password_user;
    }

    public function setPasswordUser(string $passwordUser): self
    {
        $this->password_user = $passwordUser;

        return $this;
    }

    public function getEmailUser(): ?string
    {
        return $this->email_user ;
    }

    public function setEmailUser(string $emailUser): self
    {
        $this->email_user  = $emailUser;

        return $this;
    }

    public function isIsPro(): ?bool
    {
        return $this->is_pro ;
    }

    public function setIsPro(bool $isPro): self
    {
        $this->is_pro  = $isPro;

        return $this;
    }

    public function getImgUser(): ?string
    {
        return $this->img_user;
    }

    public function setImgUser(?string $imgUser): self
    {
        $this->img_user = $imgUser;

        return $this;
    }

    public function getTypeRole(): ?Role
    {
        return $this->type_role ;
    }

    public function setTypeRole(?Role $typeRole): self
    {
        $this->type_role  = $typeRole;

        return $this;
    }

    public function getIsPro(): ?string
    {
        return $this->is_pro ;
    }


}
