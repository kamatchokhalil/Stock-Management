<?php

namespace GestionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * fournisseur
 *
 * @ORM\Table(name="fournisseur")
 * @ORM\Entity(repositoryClass="GestionBundle\Repository\fournisseurRepository")
 */
class fournisseur
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
     * @ORM\Column(name="raisonsociale", type="string", length=255)
     */
    private $raisonsociale;

    /**
     *@ORM\OneToMany(targetEntity="produit", mappedBy="fournisseur")
     */
    private $produits;

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
     * @return fournisseur
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
     * Set raisonsociale
     *
     * @param string $raisonsociale
     *
     * @return fournisseur
     */
    public function setraisonsociale($raisonsociale)
    {
        $this->raisonsociale = $raisonsociale;

        return $this;
    }

    /**
     * Get raisonsociale
     *
     * @return string
     */
    public function getraisonsociale()
    {
        return $this->raisonsociale;
    }


    /**
     * @return mixed
     */
    public function getproduits()
    {
        return $this->produits;
    }

    /**
     * @return mixed $produits
     */
    public function setproduits($produits)
    {
        $this->produits = $produits;

        return $this;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->produits = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add produit
     *
     * @param \GestionBundle\Entity\produit $produit
     *
     * @return fournisseur
     */
    public function addProduit(\GestionBundle\Entity\produit $produit)
    {
        $this->produits[] = $produit;

        return $this;
    }

    /**
     * Remove produit
     *
     * @param \GestionBundle\Entity\produit $produit
     */
    public function removeProduit(\GestionBundle\Entity\produit $produit)
    {
        $this->produits->removeElement($produit);
    }
}
