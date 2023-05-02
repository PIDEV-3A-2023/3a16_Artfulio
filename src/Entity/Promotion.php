<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Promotion
 *
 * @ORM\Table(name="promotion", indexes={@ORM\Index(name="fk_prix", columns={"prix"}), @ORM\Index(name="id_artwork", columns={"id_artwork"}), @ORM\Index(name="nom_artwork", columns={"nom_artwork"})})
 * @ORM\Entity
 */
class Promotion
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int
     *@Assert\NotBlank(message=" Type doit etre non vide")
     * @Assert\Length(
     *      min = 2,
     *      minMessage=" Entrer  remise valide"
     *
     *     )
     * @ORM\Column(name="remise", type="integer", nullable=false)
     */
    private $remise;

    /**
     * @var string
     *@Assert\NotBlank(message=" Type doit etre non vide")
     * @Assert\Length(
     *      min = 5,
     *      minMessage=" Entrer un type de promo valide"
     *
     *     )
     * @ORM\Column(name="type", type="string", length=255, nullable=false)
     */
    private $type;

    /**
     * @var int
     * 
     *@ORM\Column(name="id_artwork", type="integer",  nullable=false)
     * @ORM\ManyToOne(targetEntity="Artwork")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_artwork", referencedColumnName="id_artwork")
     * })
     */
    private $id_artwork;

    /**
     * @var string
     *@Assert\NotBlank(message=" Type doit etre non vide")
     * @Assert\Length(
     *      min = 2,
     *      minMessage=" Entrer un artwork deja existant"
     *
     *     )
     * @ORM\Column(name="nom_artwork", type="string", length=255 , nullable=false)
     * @ORM\ManyToOne(targetEntity="Artwork")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="nom_artwork", referencedColumnName="nom_artwork")
     * })
     */
    private $nomArtwork;

    /**
     * @var int
     * 
     * @Assert\NotBlank(message=" Type doit etre non vide")
     * @Assert\Length(
     *      min = 2,
     *      minMessage=" Entrer un prix valide"
     *
     *     )
     *@ORM\Column(name="prix_artwork", type="integer",  nullable=false)
     * @ORM\ManyToOne(targetEntity="Artwork")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="prix", referencedColumnName="prix_artwork")
     * })
     */
    private $prix;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRemise(): ?int
    {
        return $this->remise;
    }

    public function setRemise(int $remise): self
    {
        $this->remise = $remise;

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


    public function getNomArtwork(): ?string
    {
        return $this->nomArtwork;
    }

    public function setNomArtwork(?string $nomArtwork): self
    {
        $this->nomArtwork = $nomArtwork;

        return $this;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(?int $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getIdArtwork(): ?int
    {
        return $this->id_artwork;
    }

    public function setIdArtwork(?int $id_artwork): self
    {
        $this->id_artwork = $id_artwork;

        return $this;
    }


}
