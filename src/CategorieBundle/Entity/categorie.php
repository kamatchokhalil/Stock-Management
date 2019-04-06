<?php

namespace CategorieBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use ProduitBundle\Entity\produit;

/**
 * categorie
 *
 * @ORM\Table(name="categorie")
 * @ORM\Entity(repositoryClass="CategorieBundle\Repository\categorieRepository")
 */
class categorie
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
     * @ORM\Column(name="code", type="string", length=255)
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="designation", type="string", length=255)
     */
    private $designation;


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
     * Set code
     *
     * @param string $code
     *
     * @return categorie
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set designation
     *
     * @param string $designation
     *
     * @return categorie
     */
    public function setDesignation($designation)
    {
        $this->designation = $designation;

        return $this;
    }

    /**
     * Get designation
     *
     * @return string
     */
    public function getDesignation()
    {
        return $this->designation;
    }


    /**
     * Get produits
     *
     * @return ArrayCollection
     */
    public function getproduits()
    {
        return $this->produits;
    }

    /**
     * Set produits
     *
     * @param array $produits
     *
     * @return produit
     */
    public function setproduits($produits)
    {
        $this->produits = $produits;

        return $this;
    }
}

