<?php

namespace PersonneBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Famille
 *
 * @ORM\Table(name="famille")
 * @ORM\Entity(repositoryClass="PersonneBundle\Repository\FamilleRepository")
 */
class Famille
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nomfamille", type="string", length=255)
     */
    private $nomfamille;

    /**
     * @ORM\OneToMany(targetEntity="Personne",mappedBy="pers")
     */
    private $membres;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nomfamille
     *
     * @param string $nomfamille
     *
     * @return Famille
     */
    public function setNomfamille($nomfamille)
    {
        $this->nomfamille = $nomfamille;

        return $this;
    }

    /**
     * Get nomfamille
     *
     * @return string
     */
    public function getNomfamille()
    {
        return $this->nomfamille;
    }

    /**
     * @return mixed
     */
    public function getmembres()
    {
        return $this->membres;
    }

    /**
     * @return mixed $produits
     */
    public function setmembres($membres)
    {
        $this->membres = $membres;

        return $this;
    }
}

