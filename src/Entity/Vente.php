<?php

namespace App\Entity;

use App\Repository\VenteRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VenteRepository::class)
 */
class Vente
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateDebut;

    /**
     * @ORM\ManyToOne(targetEntity=Adresse::class, inversedBy="ventes")
     */
    private $adresseVente;

    /**
     * @ORM\ManyToOne(targetEntity=Lot::class, inversedBy="ventes")
     */
    private $lotVente;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTimeInterface $dateDebut): self
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getAdresseVente(): ?Adresse
    {
        return $this->adresseVente;
    }

    public function setAdresseVente(?Adresse $adresseVente): self
    {
        $this->adresseVente = $adresseVente;

        return $this;
    }

    public function getLotVente(): ?Lot
    {
        return $this->lotVente;
    }

    public function setLotVente(?Lot $lotVente): self
    {
        $this->lotVente = $lotVente;

        return $this;
    }
}
