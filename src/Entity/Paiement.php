<?php

namespace App\Entity;

use App\Repository\PaiementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PaiementRepository::class)
 */
class Paiement
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
    private $typePaiement;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $validationPaiement;

    /**
     * @ORM\OneToMany(targetEntity=Lot::class, mappedBy="paiement")
     */
    private $lotPaiement;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="paiements")
     */
    private $UserPaiement;

    public function __construct()
    {
        $this->lotPaiement = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypePaiement(): ?string
    {
        return $this->typePaiement;
    }

    public function setTypePaiement(string $typePaiement): self
    {
        $this->typePaiement = $typePaiement;

        return $this;
    }

    public function getValidationPaiement(): ?bool
    {
        return $this->validationPaiement;
    }

    public function setValidationPaiement(bool $validationPaiement): self
    {
        $this->validationPaiement = $validationPaiement;

        return $this;
    }

    /**
     * @return Collection|Lot[]
     */
    public function getLotPaiement(): Collection
    {
        return $this->lotPaiement;
    }

    public function addLotPaiement(Lot $lotPaiement): self
    {
        if (!$this->lotPaiement->contains($lotPaiement)) {
            $this->lotPaiement[] = $lotPaiement;
            $lotPaiement->setPaiement($this);
        }

        return $this;
    }

    public function removeLotPaiement(Lot $lotPaiement): self
    {
        if ($this->lotPaiement->removeElement($lotPaiement)) {
            // set the owning side to null (unless already changed)
            if ($lotPaiement->getPaiement() === $this) {
                $lotPaiement->setPaiement(null);
            }
        }

        return $this;
    }

    public function getUserPaiement(): ?User
    {
        return $this->UserPaiement;
    }

    public function setUserPaiement(?User $UserPaiement): self
    {
        $this->UserPaiement = $UserPaiement;

        return $this;
    }
}
