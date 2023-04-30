<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commande
 *
 * @ORM\Table(name="commande", indexes={@ORM\Index(name="IDX_6EEAA67DF7384557", columns={"id_produit"})})
 * @ORM\Entity
 */
class Commande
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_vente", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idVente;

    /**
     * @var float
     *
     * @ORM\Column(name="prix_artwork", type="float", precision=10, scale=0, nullable=false)
     */
    private $prixArtwork;

    /**
     * @var string
     *
     * @ORM\Column(name="paiement", type="string", length=255, nullable=false)
     */
    private $paiement;

    /**
     * @var \Artwork
     *
     * @ORM\ManyToOne(targetEntity="Artwork")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_produit", referencedColumnName="id_artwork")
     * })
     */
    private $idProduit;


}
