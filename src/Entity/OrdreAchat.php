<?php

namespace App\Entity;

use App\Repository\OrdreAchatRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrdreAchatRepository::class)
 */
class OrdreAchat
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $autobot;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $montantMax;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateCreation;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="ordreAchats")
     */
    private $UserOrdreAchat;

    /**
     * @ORM\ManyToOne(targetEntity=Lot::class, inversedBy="ordreAchats")
     */
    private $lotOrdreAchat;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAutobot(): ?bool
    {
        return $this->autobot;
    }

    public function setAutobot(bool $autobot): self
    {
        $this->autobot = $autobot;

        return $this;
    }

    public function getMontantMax(): ?float
    {
        return $this->montantMax;
    }

    public function setMontantMax(float $montantMax): self
    {
        $this->montantMax = $montantMax;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->dateCreation;
    }

    public function setDateCreation(\DateTimeInterface $dateCreation): self
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    public function getUserOrdreAchat(): ?User
    {
        return $this->UserOrdreAchat;
    }

    public function setUserOrdreAchat(?User $UserOrdreAchat): self
    {
        $this->UserOrdreAchat = $UserOrdreAchat;

        return $this;
    }

    public function getLotOrdreAchat(): ?Lot
    {
        return $this->lotOrdreAchat;
    }

    public function setLotOrdreAchat(?Lot $lotOrdreAchat): self
    {
        $this->lotOrdreAchat = $lotOrdreAchat;

        return $this;
    }
}
