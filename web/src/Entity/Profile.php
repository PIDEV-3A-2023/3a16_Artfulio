<?php

namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;

use Repository;
use App\Repository\ProfileRepository;

#[ORM\Entity(repositoryClass: ProfileRepository::class)]
class Profile
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id_profil  = null;
  
    #[ORM\Column]
    private ?int $id_util  = null;
   

    #[ORM\Column(length: 255)]
    private ?string $bio = null;
   

    #[ORM\Column(length: 255)]
    private ?string $ig = null;
   
 

    
    #[ORM\Column(length: 255)]
    private ?string $fb = null;
   
 

    
    #[ORM\Column(length: 255)]
    private ?string $twitter = null;
   


   
    #[ORM\Column(length: 255)]
    private ?string $ytb = null;
   


    public function getIdProfil(): ?int
    {
        return $this->id_profil ;
    }

    public function getIdUtil(): ?int
    {
        return $this->id_util ;
    }

    public function setIdUtil(int $idUtil): self
    {
        $this->id_util  = $idUtil;

        return $this;
    }

    public function getBio(): ?string
    {
        return $this->bio;
    }

    public function setBio(string $bio): self
    {
        $this->bio = $bio;

        return $this;
    }

    public function getIg(): ?string
    {
        return $this->ig;
    }

    public function setIg(string $ig): self
    {
        $this->ig = $ig;

        return $this;
    }

    public function getFb(): ?string
    {
        return $this->fb;
    }

    public function setFb(string $fb): self
    {
        $this->fb = $fb;

        return $this;
    }

    public function getTwitter(): ?string
    {
        return $this->twitter;
    }

    public function setTwitter(string $twitter): self
    {
        $this->twitter = $twitter;

        return $this;
    }

    public function getYtb(): ?string
    {
        return $this->ytb;
    }

    public function setYtb(string $ytb): self
    {
        $this->ytb = $ytb;

        return $this;
    }


}
