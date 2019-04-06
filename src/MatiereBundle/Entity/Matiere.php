<?php

namespace MatiereBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Matiere
 *
 * @ORM\Table(name="matiere")
 * @ORM\Entity(repositoryClass="MatiereBundle\Repository\MatiereRepository")
 */
class Matiere
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
     * @ORM\Column(name="NomMat", type="string", length=255)
     */
    private $nomMat;

    /**
     * @var float
     *
     * @ORM\Column(name="Coef", type="float")
     */
    private $coef;

    /**
     * @var int
     *
     * @ORM\Column(name="Niveau", type="integer")
     */
    private $niveau;

    /**
     * @var string
     *
     * @ORM\Column(name="fil", type="string", length=255)
     */
    private $fil;


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
     * Set nomMat
     *
     * @param string $nomMat
     *
     * @return Matiere
     */
    public function setNomMat($nomMat)
    {
        $this->nomMat = $nomMat;

        return $this;
    }

    /**
     * Get nomMat
     *
     * @return string
     */
    public function getNomMat()
    {
        return $this->nomMat;
    }

    /**
     * Set coef
     *
     * @param float $coef
     *
     * @return Matiere
     */
    public function setCoef($coef)
    {
        $this->coef = $coef;

        return $this;
    }

    /**
     * Get coef
     *
     * @return float
     */
    public function getCoef()
    {
        return $this->coef;
    }

    /**
     * Set niveau
     *
     * @param integer $niveau
     *
     * @return Matiere
     */
    public function setNiveau($niveau)
    {
        $this->niveau = $niveau;

        return $this;
    }

    /**
     * Get niveau
     *
     * @return int
     */
    public function getNiveau()
    {
        return $this->niveau;
    }

    /**
     * Set fil
     *
     * @param string $fil
     *
     * @return Matiere
     */
    public function setFil($fil)
    {
        $this->fil = $fil;

        return $this;
    }

    /**
     * Get fil
     *
     * @return string
     */
    public function getFil()
    {
        return $this->fil;
    }
}

