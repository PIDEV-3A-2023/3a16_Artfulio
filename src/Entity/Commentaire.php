<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

use Repository;
use App\Repository\CommentaireRepository;

#[ORM\Entity(repositoryClass: CommentaireRepository::class)]
class Commentaire
{
    #[ORM\Column(length: 255)]
    private ?string $texte = null;
  

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $Id_com   = null;
 

      #[ORM\Column(type: 'datetime')]
    private ?\DateTimeInterface $Date_post = null;
   
    //#[ORM\ManyToOne(targetEntity: Artwork::class, inversedBy: 'Commentaire')]
   // #[ORM\JoinColumn(name: 'id_artwork', referencedColumnName: 'id_artwork')]
   
    private ?int $idArtwork  = null;
    //#[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'Commentaire')]
    //#[ORM\JoinColumn(name: 'id_util', referencedColumnName: 'id_user')]
  
    private ?int $id_util   = null;

    public function getTexte(): ?string
    {
        return $this->texte;
    }

    public function setTexte(string $texte): self
    {
        $this->texte = $texte;

        return $this;
    }

    public function getIdCom(): ?int
    {
        return $this->Id_com ;
    }

    public function getDatePost(): ?\DateTimeInterface
    {
        return $this->Date_post;
    }

    public function setDatePost(\DateTimeInterface $datePost): self
    {
        $this->Date_post = $datePost;

        return $this;
    }

    public function getIdArtwork(): ?Artwork
    {
        return $this->id_artwork ;
    }

    public function setIdArtwork(?Artwork $idArtwork): self
    {
        $this->id_artwork  = $idArtwork;

        return $this;
    }

    public function getIdUtil(): ?User
    {
        return $this->id_util ;
    }

    public function setIdUtil(?User $idUtil): self
    {
        $this->id_util  = $idUtil;

        return $this;
    }


}
