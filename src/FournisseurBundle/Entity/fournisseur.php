<?php

namespace FournisseurBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * fournisseur
 *
 * @ORM\Table(name="four1")
 * @ORM\Entity(repositoryClass="FournisseurBundle\Repository\fournisseurRepository")
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
    public function setRaisonsociale($raisonsociale)
    {
        $this->raisonsociale = $raisonsociale;

        return $this;
    }

    /**
     * Get raisonsociale
     *
     * @return string
     */
    public function getRaisonsociale()
    {
        return $this->raisonsociale;
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

