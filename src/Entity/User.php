<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Repository;
use App\Repository\UserRepository;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id= null;



    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"Ce champs est obligatoire")]
            #[Assert\Length(
                min: 2,
                minMessage: 'Votre mot de passe ne contient pas {{
                    limit }} caractères'
            )]
    private ?string $username = null;
 


    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"Ce champs est obligatoire")]
    #[Assert\Length(
          exact:8,
          exactMessage:'La valeur du CIN doit contenir exactement {{ limit }} caractères.'
        )]
    #[Assert\Regex(
        pattern:'/^0/',
         message:'La valeur du CIN doit commencer par "0".'
        )]
    private ?string $cin_user = null;
 



    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"Ce champs est obligatoire")]
    private ?string $adresse_user = null;
 
  


    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"Ce champs est obligatoire")]
    #[Assert\Regex(
     pattern:'/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{6,}$/',
     message:'Le mot de passe doit contenir au moins une lettre minuscule, une lettre majuscule et un chiffre.' )]
    private ?string $password_user = null;
 
  


    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"Ce champs est obligatoire")]
    #[Assert\Email(message:"L'adresse email '{{ value }}' n'est pas valide.")]
    private ?string $email_user  = null;
 


  
    #[ORM\Column]
    private ?bool $is_pro  = false;

    

    #[ORM\Column(length: 255)]
    private ?string $img_user	 = null;

    // #[ORM\ManyToOne(targetEntity: Role::class, inversedBy: 'User')]
    // #[ORM\JoinColumn(name: 'type_role', referencedColumnName: 'type_role')]
    
    private ?string $type_role  = null;

    #[ORM\OneToMany(mappedBy: 'id_artist', targetEntity: Artwork::class)]
    private Collection $artworks;

    #[ORM\OneToMany(mappedBy: 'id_util', targetEntity: Commentaire::class)]
    private Collection $commentaires;

    public function __construct()
    {
        $this->artworks = new ArrayCollection();
        $this->commentaires = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection<int, Artwork>
     */
    public function getArtworks(): Collection
    {
        return $this->artworks;
    }

    public function addArtwork(Artwork $artwork): self
    {
        if (!$this->artworks->contains($artwork)) {
            $this->artworks->add($artwork);
            $artwork->setIdArtist($this);
        }

        return $this;
    }

    public function removeArtwork(Artwork $artwork): self
    {
        if ($this->artworks->removeElement($artwork)) {
            // set the owning side to null (unless already changed)
            if ($artwork->getIdArtist() === $this) {
                $artwork->setIdArtist(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Commentaire>
     */
    public function getCommentaires(): Collection
    {
        return $this->commentaires;
    }

    public function addCommentaire(Commentaire $commentaire): self
    {
        if (!$this->commentaires->contains($commentaire)) {
            $this->commentaires->add($commentaire);
            $commentaire->setIdUtil($this);
        }

        return $this;
    }

    public function removeCommentaire(Commentaire $commentaire): self
    {
        if ($this->commentaires->removeElement($commentaire)) {
            // set the owning side to null (unless already changed)
            if ($commentaire->getIdUtil() === $this) {
                $commentaire->setIdUtil(null);
            }
        }

        return $this;
    }


}
