<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Store
 *
 * @ORM\Table(name="store", indexes={@ORM\Index(name="IDX_FF575877CF1D26F5", columns={"id_piece_art"})})
 * @ORM\Entity
 */
class Store
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_produit", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idProduit;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_artwork", type="string", length=255, nullable=false)
     */
    private $nomArtwork;

    /**
     * @var float
     *
     * @ORM\Column(name="prix_artwork", type="float", precision=10, scale=0, nullable=false)
     */
    private $prixArtwork;

    /**
     * @var string
     *
     * @ORM\Column(name="img_artwork", type="string", length=255, nullable=false)
     */
    private $imgArtwork;

    /**
     * @var \Artwork
     *
     * @ORM\ManyToOne(targetEntity="Artwork")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_piece_art", referencedColumnName="id_artwork")
     * })
     */
    private $idPieceArt;


}
