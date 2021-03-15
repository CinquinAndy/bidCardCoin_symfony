<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProduitRepository::class)
 */
class Produit
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nomArtiste;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nomStyle;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nomProduit;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $prixReserve;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $referenceCatalogue;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $estEnvoyer;


    public function __construct()
    {

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomArtiste(): ?string
    {
        return $this->nomArtiste;
    }

    public function setNomArtiste(string $nomArtiste): self
    {
        $this->nomArtiste = $nomArtiste;

        return $this;
    }

    public function getNomStyle(): ?string
    {
        return $this->nomStyle;
    }

    public function setNomStyle(string $nomStyle): self
    {
        $this->nomStyle = $nomStyle;

        return $this;
    }

    public function getNomProduit(): ?string
    {
        return $this->nomProduit;
    }

    public function setNomProduit(string $nomProduit): self
    {
        $this->nomProduit = $nomProduit;

        return $this;
    }

    public function getPrixReserve(): ?float
    {
        return $this->prixReserve;
    }

    public function setPrixReserve(float $prixReserve): self
    {
        $this->prixReserve = $prixReserve;

        return $this;
    }

    public function getReferenceCatalogue(): ?string
    {
        return $this->referenceCatalogue;
    }

    public function setReferenceCatalogue(string $referenceCatalogue): self
    {
        $this->referenceCatalogue = $referenceCatalogue;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getEstEnvoyer(): ?bool
    {
        return $this->estEnvoyer;
    }

    public function setEstEnvoyer(bool $estEnvoyer): self
    {
        $this->estEnvoyer = $estEnvoyer;

        return $this;
    }
}
