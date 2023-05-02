<?php

namespace App\Entity;

use App\Repository\ArtistRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: ArtistRepository::class)]
class Artist implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $username = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\OneToMany(mappedBy: 'idUser', targetEntity: Parrainage::class)]
    private Collection $parrainages;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: EventLike::class)]
    private Collection $eventLikes;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: ParticipEvent::class)]
    private Collection $participEvents;

    public function __construct()
    {
        $this->parrainages = new ArrayCollection();
        $this->eventLikes = new ArrayCollection();
        $this->participEvents = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->username;
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return Collection<int, Parrainage>
     */
    public function getParrainages(): Collection
    {
        return $this->parrainages;
    }

    public function addParrainage(Parrainage $parrainage): self
    {
        if (!$this->parrainages->contains($parrainage)) {
            $this->parrainages->add($parrainage);
            $parrainage->setIdUser($this);
        }

        return $this;
    }

    public function removeParrainage(Parrainage $parrainage): self
    {
        if ($this->parrainages->removeElement($parrainage)) {
            // set the owning side to null (unless already changed)
            if ($parrainage->getIdUser() === $this) {
                $parrainage->setIdUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, EventLike>
     */
    public function getEventLikes(): Collection
    {
        return $this->eventLikes;
    }

    public function addEventLike(EventLike $eventLike): self
    {
        if (!$this->eventLikes->contains($eventLike)) {
            $this->eventLikes->add($eventLike);
            $eventLike->setUser($this);
        }

        return $this;
    }

    public function removeEventLike(EventLike $eventLike): self
    {
        if ($this->eventLikes->removeElement($eventLike)) {
            // set the owning side to null (unless already changed)
            if ($eventLike->getUser() === $this) {
                $eventLike->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ParticipEvent>
     */
    public function getParticipEvents(): Collection
    {
        return $this->participEvents;
    }

    public function addParticipEvent(ParticipEvent $participEvent): self
    {
        if (!$this->participEvents->contains($participEvent)) {
            $this->participEvents->add($participEvent);
            $participEvent->setUser($this);
        }

        return $this;
    }

    public function removeParticipEvent(ParticipEvent $participEvent): self
    {
        if ($this->participEvents->removeElement($participEvent)) {
            // set the owning side to null (unless already changed)
            if ($participEvent->getUser() === $this) {
                $participEvent->setUser(null);
            }
        }

        return $this;
    }
}
