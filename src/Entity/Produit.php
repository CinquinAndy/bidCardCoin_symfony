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

    /**
     * @ORM\ManyToMany(targetEntity=Categorie::class, mappedBy="produit")
     */
    private $categories;

    /**
     * @ORM\OneToMany(targetEntity=Estimation::class, mappedBy="produit")
     */
    private $estimations;

    /**
     * @ORM\ManyToOne(targetEntity=Lot::class, inversedBy="produit")
     */
    private $lot;

    /**
     * @ORM\ManyToOne(targetEntity=Stock::class, inversedBy="produits")
     */
    private $stock;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $photo;


    public function __construct()
    {
        $this->categories = new ArrayCollection();
        $this->estimations = new ArrayCollection();
    }

    public function __toString():?string{
        return (string)('id: ' . $this->getId() .
            '|| nomArtiste: ' . $this->getNomArtiste() .
            '|| nomStyle: ' . $this->getNomStyle() .
            '|| nomProduit: ' . $this->getNomProduit() .
            '|| prixReserve: ' . $this->getPrixReserve() .
            '|| referenceCatalogue: ' . $this->getReferenceCatalogue() .
            '|| description: ' . $this->getDescription() .
            '|| estEnvoyer: ' . $this->getEstEnvoyer() .
            '|| photo: ' . $this->getPhoto());
    }
    //'|| roles'
    //'|| categories: ' . $this->getWholeCategories() .
    //'|| estimations: ' . $this->getEstimations()->__toString() .
    //'|| lot: ' . $this->getLot()->__toString() .
    //'|| stock: ' . $this->getStock()->__toString() .
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

    /**
     * @return Collection|Categorie[]
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function getWholeCategories(): string{
        $stringCategorie='';
        foreach ($this->getCategories() as $categorie){
            $stringCategorie+=$categorie->__toString();
        }
        return $stringCategorie;
    }

    public function addCategory(Categorie $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
            $category->addProduit($this);
        }

        return $this;
    }

    public function removeCategory(Categorie $category): self
    {
        if ($this->categories->removeElement($category)) {
            $category->removeProduit($this);
        }

        return $this;
    }

    /**
     * @return Collection|Estimation[]
     */
    public function getEstimations(): Collection
    {
        return $this->estimations;
    }

    public function addEstimation(Estimation $estimation): self
    {
        if (!$this->estimations->contains($estimation)) {
            $this->estimations[] = $estimation;
            $estimation->setProduit($this);
        }

        return $this;
    }

    public function removeEstimation(Estimation $estimation): self
    {
        if ($this->estimations->removeElement($estimation)) {
            // set the owning side to null (unless already changed)
            if ($estimation->getProduit() === $this) {
                $estimation->setProduit(null);
            }
        }

        return $this;
    }

    public function getLot(): ?Lot
    {
        return $this->lot;
    }

    public function setLot(?Lot $lot): self
    {
        $this->lot = $lot;

        return $this;
    }

    public function getStock(): ?Stock
    {
        return $this->stock;
    }

    public function setStock(?Stock $stock): self
    {
        $this->stock = $stock;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public function getWholePriceEstimations(): ?int
    {
        // pour le prix d'un produit, on fais la moyenne des estimations, ou on récupére le prix de reserve minimum
        // d'un produit
        $total=0;
        $i=0;
        foreach ($this->estimations as $estimate){
            $i++;
            $total+=$estimate->getPrix();
        }
        if($total>0){
            $total/=$i;
        }else{
            $total=$this->getPrixReserve();
        }

        return $total;
    }

    public function getCategoriesString():?string
    {
        $stringCategorie="";
        $i=0;
        foreach($this->categories as $category){
            if($i===0){
                $stringCategorie.=$category->getNom();
            } else{
                $stringCategorie.=";".$category->getNom();
            }
            $i++;
        }
        return $stringCategorie;
    }
}
