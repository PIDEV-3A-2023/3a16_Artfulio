<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

/**
 * Service
 *
 * @ORM\Table(name="service", indexes={@ORM\Index(name="fk_id_categorie", columns={"fk_id_categorie"})})
 * @ORM\Entity
 */
class Service
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_service", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idService;

    /**
     * @var string
     *
     * @ORM\Column(name="description_service", type="string", length=255, nullable=false)
      * @Assert\NotBlank(message="Description doit être non vide")
     */
    private $descriptionService;

    /**
     * @var string
     *
     * @ORM\Column(name="date_service", type="string", length=255, nullable=false)
     * @Assert\Date(
 *      message = "La date '{{ value }}' n'est pas une date valide."
 * )
     */
    private $dateService;

    /**
     * @var int
     *
     * @ORM\Column(name="prix_service", type="integer", nullable=false)
     * @Assert\NotBlank(message="Prix doit être supérieur à 0")
     */
    private $prixService;

    /**
     * @var string
     *
     * @ORM\Column(name="type_paiement_service", type="string", length=255, nullable=false)
     * @Assert\NotBlank(message="Type doit être non vide")
     * @Assert\Choice(choices={"cash", "carte"}, message="Veuillez choisir entre 'cash' ou 'carte'")
     */
    private $typePaiementService;

 
    /**
     * @var \Categorie
     *
     * @ORM\ManyToOne(targetEntity="Categorie")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fk_id_categorie", referencedColumnName="id_categorie")
     * })
     * @Assert\NotBlank(message="Type doit être non vide")
     */
    private $fkIdCategorie;

    public function getIdService(): ?int
    {
        return $this->idService;
    }

    public function getDescriptionService(): ?string
    {
        return $this->descriptionService;
    }

    public function setDescriptionService(string $descriptionService): self
    {
        $this->descriptionService = $descriptionService;

        return $this;
    }

    public function getDateService(): ?string
    {
        return $this->dateService;
    }

    public function setDateService(string $dateService): self
    {
        $this->dateService = $dateService;

        return $this;
    }

    public function getPrixService(): ?int
    {
        return abs($this->prixService);
    }
  

    public function setPrixService(int $prixService): self
    {
        $this->prixService = $prixService;

        return $this;
    }

    public function getTypePaiementService(): ?string
    {
        return $this->typePaiementService;
    }

    public function setTypePaiementService(string $typePaiementService): self
    {
        $this->typePaiementService = $typePaiementService;

        return $this;
    }

    public function getFkIdCategorie(): ?Categorie
    {
        return $this->fkIdCategorie;
    }

    public function setFkIdCategorie(?Categorie $fkIdCategorie): self
    {
        $this->fkIdCategorie = $fkIdCategorie;

        return $this;
    }
   

}
