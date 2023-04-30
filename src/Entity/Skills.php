<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Skills
 *
 * @ORM\Table(name="skills", indexes={@ORM\Index(name="IDX_D53116705FCA037F", columns={"id_profile"})})
 * @ORM\Entity
 */
class Skills
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_skill", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idSkill;

    /**
     * @var string
     *
     * @ORM\Column(name="titre_skill", type="string", length=255, nullable=false)
     */
    private $titreSkill;

    /**
     * @var string
     *
     * @ORM\Column(name="desc_skill", type="string", length=255, nullable=false)
     */
    private $descSkill;

    /**
     * @var \Profile
     *
     * @ORM\ManyToOne(targetEntity="Profile")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_profile", referencedColumnName="id_profil")
     * })
     */
    private $idProfile;


}
