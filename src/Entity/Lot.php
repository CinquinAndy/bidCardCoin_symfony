<?php

namespace App\Entity;

use App\Repository\LotRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LotRepository::class)
 */
class Lot
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
    private $nom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=Enchere::class, mappedBy="lot")
     */
    private $encheres;

    /**
     * @ORM\ManyToOne(targetEntity=Vente::class, inversedBy="lots")
     */
    private $vente;

    /**
     * @ORM\OneToMany(targetEntity=Produit::class, mappedBy="lot")
     */
    private $produit;

    /**
     * @ORM\OneToMany(targetEntity=OrdreAchat::class, mappedBy="lot")
     */
    private $ordreAchats;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, inversedBy="lots")
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $photo;


    public function __construct()
    {
        $this->encheres = new ArrayCollection();
        $this->userRecuperation = new ArrayCollection();
        $this->userVente = new ArrayCollection();
        $this->produit = new ArrayCollection();
        $this->ordreAchats = new ArrayCollection();
        $this->user = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }
    public function getIdString(): ?string
    {
        return (string)$this->id;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|Enchere[]
     */
    public function getEncheres(): Collection
    {
        return $this->encheres;
    }

    public function addEnchere(Enchere $enchere): self
    {
        if (!$this->encheres->contains($enchere)) {
            $this->encheres[] = $enchere;
            $enchere->setLot($this);
        }

        return $this;
    }

    public function removeEnchere(Enchere $enchere): self
    {
        if ($this->encheres->removeElement($enchere)) {
            // set the owning side to null (unless already changed)
            if ($enchere->getLot() === $this) {
                $enchere->setLot(null);
            }
        }

        return $this;
    }

    public function getVente(): ?Vente
    {
        return $this->vente;
    }

    public function setVente(?Vente $vente): self
    {
        $this->vente = $vente;

        return $this;
    }

    /**
     * @return Collection|Produit[]
     */
    public function getProduit(): Collection
    {
        return $this->produit;
    }

    public function addProduit(Produit $produit): self
    {
        if (!$this->produit->contains($produit)) {
            $this->produit[] = $produit;
            $produit->setLot($this);
        }

        return $this;
    }

    public function removeProduit(Produit $produit): self
    {
        if ($this->produit->removeElement($produit)) {
            // set the owning side to null (unless already changed)
            if ($produit->getLot() === $this) {
                $produit->setLot(null);
            }
        }

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
            $ordreAchat->setLot($this);
        }

        return $this;
    }

    public function removeOrdreAchat(OrdreAchat $ordreAchat): self
    {
        if ($this->ordreAchats->removeElement($ordreAchat)) {
            // set the owning side to null (unless already changed)
            if ($ordreAchat->getLot() === $this) {
                $ordreAchat->setLot(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUser(): Collection
    {
        return $this->user;
    }

    public function addUser(User $user): self
    {
        if (!$this->user->contains($user)) {
            $this->user[] = $user;
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        $this->user->removeElement($user);

        return $this;
    }

    public function getNumberOfProducts():?int
    {
        $count=0;
        foreach ($this->produit as $product) {
            $count++;
        }
        return $count;
    }

    public function getPrixOfProducts():?int
    {
        $count=0;
        foreach ($this->produit as $product) {
            $count+=$product->getPrixReserve();
        }
        return $count;
    }

    public function getDateVenteLot():?string
    {
        $dateTime=$this->vente->getDateDebut();
        if($dateTime===null || $dateTime===0) {
            $dateTime=new DateTime('NOW');
        }
        return $dateTime->format('d/m/Y H:i');
    }

    public function getLieuVenteLot():?string
    {
        return ("{$this->vente->getAdresse()->getPays()} - {$this->vente->getAdresse()->getVille()} - {$this->vente->getAdresse()->getRue()}");
    }

    public function getIdArray(): ?array
    {
        return array($this->id);
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

}
