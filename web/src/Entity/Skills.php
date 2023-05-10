<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

use Repository;
use App\Repository\SkillsRepository;

#[ORM\Entity(repositoryClass: SkillsRepository::class)]
class Skills
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id_skill   = null;


    #[ORM\Column(length: 255)]
    private ?string $titre_skill = null;


    #[ORM\Column(length: 255)]
    private ?string $desc_skill = null;

    #[ORM\ManyToOne(targetEntity: Profile::class, inversedBy: 'Skills')]
    #[ORM\JoinColumn(name: 'id_profile', referencedColumnName: 'id_profil')]
    private ?int $id_profile  = null;
  

    public function getIdSkill(): ?int
    {
        return $this->id_skill ;
    }

    public function getTitreSkill(): ?string
    {
        return $this->titre_skill;
    }

    public function setTitreSkill(string $titreSkill): self
    {
        $this->titre_skill = $titreSkill;

        return $this;
    }

    public function getDescSkill(): ?string
    {
        return $this->desc_skill;
    }

    public function setDescSkill(string $descSkill): self
    {
        $this->desc_skill = $descSkill;

        return $this;
    }

    public function getIdProfile(): ?Profile
    {
        return $this->id_profile ;
    }

    public function setIdProfile(?Profile $idProfile): self
    {
        $this->id_profile  = $idProfile;

        return $this;
    }


}
