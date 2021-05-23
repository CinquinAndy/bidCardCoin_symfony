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
     * @ORM\GeneratedValue(strategy="AUTO")
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
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="paiements")
     */
    private $user;

    /**
     * @ORM\OneToOne(targetEntity=Lot::class, cascade={"persist", "remove"})
     */
    private $lot;


    public function __construct()
    {

    }

    public function __toString()
    {
        return (string)('id: ' . $this->getId() .
            '|| typePaiement: ' . $this->getTypePaiement() .
            '|| validationPaiement: ' . $this->getValidationPaiement());
        //'|| user: ' . $this->getUser()->__toString() .
        //'|| lot: ' . $this->getlot()->__toString());
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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

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


}
