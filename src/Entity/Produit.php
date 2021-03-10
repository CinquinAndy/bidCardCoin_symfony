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
     * @ORM\GeneratedValue
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

    /**
     * @ORM\ManyToOne(targetEntity=Lot::class, inversedBy="produits")
     */
    private $lotProduit;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="produits")
     */
    private $UserProduit;

    /**
     * @ORM\OneToOne(targetEntity=Enchere::class, cascade={"persist", "remove"})
     */
    private $enchereGagnante;

    /**
     * @ORM\ManyToMany(targetEntity=Categorie::class, inversedBy="produits")
     */
    private $categorieProduit;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="produits")
     */
    private $stockProduit;

    public function __construct()
    {
        $this->categorieProduit = new ArrayCollection();
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

    public function getLotProduit(): ?Lot
    {
        return $this->lotProduit;
    }

    public function setLotProduit(?Lot $lotProduit): self
    {
        $this->lotProduit = $lotProduit;

        return $this;
    }

    public function getUserProduit(): ?User
    {
        return $this->UserProduit;
    }

    public function setUserProduit(?User $UserProduit): self
    {
        $this->UserProduit = $UserProduit;

        return $this;
    }

    public function getEnchereGagnante(): ?Enchere
    {
        return $this->enchereGagnante;
    }

    public function setEnchereGagnante(?Enchere $enchereGagnante): self
    {
        $this->enchereGagnante = $enchereGagnante;

        return $this;
    }

    /**
     * @return Collection|Categorie[]
     */
    public function getCategorieProduit(): Collection
    {
        return $this->categorieProduit;
    }

    public function addCategorieProduit(Categorie $categorieProduit): self
    {
        if (!$this->categorieProduit->contains($categorieProduit)) {
            $this->categorieProduit[] = $categorieProduit;
        }

        return $this;
    }

    public function removeCategorieProduit(Categorie $categorieProduit): self
    {
        $this->categorieProduit->removeElement($categorieProduit);

        return $this;
    }

    public function getStockProduit(): ?User
    {
        return $this->stockProduit;
    }

    public function setStockProduit(?User $stockProduit): self
    {
        $this->stockProduit = $stockProduit;

        return $this;
    }
}
