<?php

namespace App\Entity;

use App\Repository\EvenementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EvenementRepository::class)]
class Evenement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"peut pas etre vide")]

    private ?string $titre = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"peut pas etre vide")]

    private ?string $type = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"peut pas etre vide")]

    private ?string $description = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Assert\NotBlank(message:"peut pas etre vide")]

    private ?\DateTimeInterface $dateDebut = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Assert\NotBlank(message:"peut pas etre vide")]

    private ?\DateTimeInterface $dateFin = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"peut pas etre vide")]

    private ?string $image = null;

    #[ORM\Column]
    #[Assert\NotBlank(message:"peut pas etre vide")]

    private ?float $longitude = null;

    #[ORM\Column]
    #[Assert\NotBlank(message:"peut pas etre vide")]

    private ?float $latitude = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"peut pas etre vide")]

    private ?string $adresse = null;

    #[ORM\OneToMany(mappedBy: 'evenement', targetEntity: EventLike::class)]
    private Collection $likes;

    #[ORM\OneToMany(mappedBy: 'evenement', targetEntity: ParticipEvent::class)]
    private Collection $participes;

    public function __construct()
    {
        $this->likes = new ArrayCollection();
        $this->participes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

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

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTimeInterface $dateDebut): self
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(\DateTimeInterface $dateFin): self
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function setLongitude(float $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function setLatitude(float $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * @return Collection<int, EventLike>
     */
    public function getLikes(): Collection
    {
        return $this->likes;
    }

    public function addLike(EventLike $like): self
    {
        if (!$this->likes->contains($like)) {
            $this->likes->add($like);
            $like->setEvenement($this);
        }

        return $this;
    }

    public function removeLike(EventLike $like): self
    {
        if ($this->likes->removeElement($like)) {
            // set the owning side to null (unless already changed)
            if ($like->getEvenement() === $this) {
                $like->setEvenement(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ParticipEvent>
     */
    public function getParticipes(): Collection
    {
        return $this->participes;
    }

    public function addParticipe(ParticipEvent $participe): self
    {
        if (!$this->participes->contains($participe)) {
            $this->participes->add($participe);
            $participe->setEvenement($this);
        }

        return $this;
    }

    public function removeParticipe(ParticipEvent $participe): self
    {
        if ($this->participes->removeElement($participe)) {
            // set the owning side to null (unless already changed)
            if ($participe->getEvenement() === $this) {
                $participe->setEvenement(null);
            }
        }

        return $this;
    }
}
