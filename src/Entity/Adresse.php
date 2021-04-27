<?php

namespace App\Entity;

use App\Repository\AdresseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AdresseRepository::class)
 */
class Adresse
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
    private $pays;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ville;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $codePostal;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $rue;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, inversedBy="adresses")
     */
    private $user;

    /**
     * @ORM\OneToOne(targetEntity=Stock::class, cascade={"persist", "remove"})
     */
    private $stock;

    /**
     * @ORM\OneToMany(targetEntity=Vente::class, mappedBy="adresse")
     */
    private $vente;




    public function __construct()
    {
        $this->user = new ArrayCollection();
        $this->vente = new ArrayCollection();
    }

    public function __toString(): ?string
    {
        return (string)('id: ' . $this->getId() .
            ' || pays: ' . $this->getPays() .
            ' || ville: ' . $this->getVille() .
            ' || codePostal: ' . $this->getCodePostal() .
            ' || rue: ' . $this->getRue());
            //'|| user: ' . $this->getUser()->__toString() .
            //'|| stock: ' . $this->getStock()->__toString());
            //'|| vente: ' . $this->getVente()->__toString());
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPays(): ?string
    {
        return $this->pays;
    }

    public function setPays(string $pays): self
    {
        $this->pays = $pays;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getCodePostal(): ?string
    {
        return $this->codePostal;
    }

    public function setCodePostal(string $codePostal): self
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    public function getRue(): ?string
    {
        return $this->rue;
    }

    public function setRue(string $rue): self
    {
        $this->rue = $rue;

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

    public function getStock(): ?Stock
    {
        return $this->stock;
    }

    public function setStock(?Stock $stock): self
    {
        $this->stock = $stock;

        return $this;
    }

    /**
     * @return Collection|Vente[]
     */
    public function getVente(): Collection
    {
        return $this->vente;
    }

    public function addVente(Vente $vente): self
    {
        if (!$this->vente->contains($vente)) {
            $this->vente[] = $vente;
            $vente->setAdresse($this);
        }

        return $this;
    }

    public function removeVente(Vente $vente): self
    {
        if ($this->vente->removeElement($vente)) {
            // set the owning side to null (unless already changed)
            if ($vente->getAdresse() === $this) {
                $vente->setAdresse(null);
            }
        }

        return $this;
    }


}
