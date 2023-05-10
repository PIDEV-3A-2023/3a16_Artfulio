<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Groups;
#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups("post:read")]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    #[Groups("post:read")]
    private ?string $email = null;

    #[ORM\Column]
    #[Groups("post:read")]
    private array $roles = [];

    /**
     * @var string The hashed password
     *
     */
    #[ORM\Column]
    #[Groups("post:read")]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    #[Groups("post:read")]
    private ?string $cin_user = null;
    #[ORM\Column(length: 255)]
    #[Groups("post:read")]
    private ?string $adresse_user = null;
    #[ORM\Column(length: 255)]
    #[Groups("post:read")]
    private ?string $username = null;
    #[ORM\Column(length: 255)]
    #[Groups("post:read")]
    private ?string $img_user	 = null;
    #[ORM\OneToMany(mappedBy: 'id_artist', targetEntity: Artwork::class)]
    private Collection $artworks;

    #[ORM\OneToMany(mappedBy: 'id_util', targetEntity: Commentaire::class)]
    private Collection $commentaires;

    public function __construct()
    {
        $this->artworks = new ArrayCollection();
        $this->commentaires = new ArrayCollection();
    } public function getCinUser(): ?string
    {
        return $this->cin_user	;
    }

    public function setCinUser(string $cinUser): self
    {
        $this->cin_user	 = $cinUser;

        return $this;
    } public function getAdresseUser(): ?string
    {
        return $this->adresse_user;
    }

    public function setAdresseUser(string $adresseUser): self
    {
        $this->adresse_user = $adresseUser;

        return $this;
    } public function getImgUser(): ?string
    {
        return $this->img_user;
    } public function setImgUser(?string $imgUser): self
    {
        $this->img_user = $imgUser;

        return $this;
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }
    public function setIdu(int $email): self
    {
        $this->id = $email;

        return $this;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->username;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }
    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }
}
