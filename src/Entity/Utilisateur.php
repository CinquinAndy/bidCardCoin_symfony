<?php

namespace App\Entity;

use App\Repository\UtilisateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UtilisateurRepository::class)
 */
class Utilisateur
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="integer")
     */
    private $age;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $numeroMobile;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $numeroFixe;

    /**
     * @ORM\Column(type="boolean")
     */
    private $verifSolvabilite;

    /**
     * @ORM\Column(type="boolean")
     */
    private $verifIdentite;

    /**
     * @ORM\Column(type="boolean")
     */
    private $verifRessortissant;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="boolean")
     */
    private $estCommissairePriseur;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $listeMotCle;

    /**
     * @ORM\ManyToOne(targetEntity=Adresse::class, inversedBy="utilisateurs")
     */
    private $adresse;

    /**
     * @ORM\OneToMany(targetEntity=OrdreAchat::class, mappedBy="utilisateurOrdreAchat")
     */
    private $ordreAchats;

    /**
     * @ORM\OneToMany(targetEntity=Paiement::class, mappedBy="utilisateurPaiement")
     */
    private $paiements;

    /**
     * @ORM\OneToMany(targetEntity=Produit::class, mappedBy="utilisateurProduit")
     */
    private $produits;

    public function __construct()
    {
        $this->ordreAchats = new ArrayCollection();
        $this->paiements = new ArrayCollection();
        $this->produits = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getNumeroMobile(): ?string
    {
        return $this->numeroMobile;
    }

    public function setNumeroMobile(?string $numeroMobile): self
    {
        $this->numeroMobile = $numeroMobile;

        return $this;
    }

    public function getNumeroFixe(): ?string
    {
        return $this->numeroFixe;
    }

    public function setNumeroFixe(?string $numeroFixe): self
    {
        $this->numeroFixe = $numeroFixe;

        return $this;
    }

    public function getVerifSolvabilite(): ?bool
    {
        return $this->verifSolvabilite;
    }

    public function setVerifSolvabilite(bool $verifSolvabilite): self
    {
        $this->verifSolvabilite = $verifSolvabilite;

        return $this;
    }

    public function getVerifIdentite(): ?bool
    {
        return $this->verifIdentite;
    }

    public function setVerifIdentite(bool $verifIdentite): self
    {
        $this->verifIdentite = $verifIdentite;

        return $this;
    }

    public function getVerifRessortissant(): ?bool
    {
        return $this->verifRessortissant;
    }

    public function setVerifRessortissant(bool $verifRessortissant): self
    {
        $this->verifRessortissant = $verifRessortissant;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getEstCommissairePriseur(): ?bool
    {
        return $this->estCommissairePriseur;
    }

    public function setEstCommissairePriseur(bool $estCommissairePriseur): self
    {
        $this->estCommissairePriseur = $estCommissairePriseur;

        return $this;
    }

    public function getListeMotCle(): ?string
    {
        return $this->listeMotCle;
    }

    public function setListeMotCle(string $listeMotCle): self
    {
        $this->listeMotCle = $listeMotCle;

        return $this;
    }

    public function getAdresse(): ?Adresse
    {
        return $this->adresse;
    }

    public function setAdresse(?Adresse $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * @return Collection|OrdreAchat[]
     */
    public function getOrdreAchats(): Collection
    {
        return $this->ordreAchats;
    }

    public function addOrdreAchat(OrdreAchat $ordreAchat): self
    {
        if (!$this->ordreAchats->contains($ordreAchat)) {
            $this->ordreAchats[] = $ordreAchat;
            $ordreAchat->setUtilisateurOrdreAchat($this);
        }

        return $this;
    }

    public function removeOrdreAchat(OrdreAchat $ordreAchat): self
    {
        if ($this->ordreAchats->removeElement($ordreAchat)) {
            // set the owning side to null (unless already changed)
            if ($ordreAchat->getUtilisateurOrdreAchat() === $this) {
                $ordreAchat->setUtilisateurOrdreAchat(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Paiement[]
     */
    public function getPaiements(): Collection
    {
        return $this->paiements;
    }

    public function addPaiement(Paiement $paiement): self
    {
        if (!$this->paiements->contains($paiement)) {
            $this->paiements[] = $paiement;
            $paiement->setUtilisateurPaiement($this);
        }

        return $this;
    }

    public function removePaiement(Paiement $paiement): self
    {
        if ($this->paiements->removeElement($paiement)) {
            // set the owning side to null (unless already changed)
            if ($paiement->getUtilisateurPaiement() === $this) {
                $paiement->setUtilisateurPaiement(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Produit[]
     */
    public function getProduits(): Collection
    {
        return $this->produits;
    }

    public function addProduit(Produit $produit): self
    {
        if (!$this->produits->contains($produit)) {
            $this->produits[] = $produit;
            $produit->setUtilisateurProduit($this);
        }

        return $this;
    }

    public function removeProduit(Produit $produit): self
    {
        if ($this->produits->removeElement($produit)) {
            // set the owning side to null (unless already changed)
            if ($produit->getUtilisateurProduit() === $this) {
                $produit->setUtilisateurProduit(null);
            }
        }

        return $this;
    }
}
