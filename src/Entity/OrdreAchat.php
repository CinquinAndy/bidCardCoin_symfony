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
     * @ORM\GeneratedValue(strategy="AUTO")
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
     * @ORM\ManyToOne(targetEntity=Enchere::class, inversedBy="ordreAchat")
     */
    private $enchere;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="ordreAchats")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Lot::class, inversedBy="ordreAchats")
     */
    private $lot;

    public function __toString()
    {
        return (string)('id: ' . $this->getId() .
            '|| autobot: ' . $this->getAutobot() .
            '|| montantMax: ' . $this->getMontantMax() .
            '|| getDateCreation: ' . $this->getDateCreation()->__toString());
        //'|| enchere: ' . $this->getEnchere()->__toString() .
        //'|| user: ' . $this->getUser()->__toString() .
        //'|| lot: ' . $this->getlot()->__toString());
    }

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

    public function getEnchere(): ?Enchere
    {
        return $this->enchere;
    }

    public function setEnchere(?Enchere $enchere): self
    {
        $this->enchere = $enchere;

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
