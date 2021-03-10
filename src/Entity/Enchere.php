<?php

namespace App\Entity;

use App\Repository\EnchereRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EnchereRepository::class)
 */
class Enchere
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $prixProposer;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $estAdjuger;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateHeureVente;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrixProposer(): ?float
    {
        return $this->prixProposer;
    }

    public function setPrixProposer(float $prixProposer): self
    {
        $this->prixProposer = $prixProposer;

        return $this;
    }

    public function getEstAdjuger(): ?bool
    {
        return $this->estAdjuger;
    }

    public function setEstAdjuger(bool $estAdjuger): self
    {
        $this->estAdjuger = $estAdjuger;

        return $this;
    }

    public function getDateHeureVente(): ?\DateTimeInterface
    {
        return $this->dateHeureVente;
    }

    public function setDateHeureVente(\DateTimeInterface $dateHeureVente): self
    {
        $this->dateHeureVente = $dateHeureVente;

        return $this;
    }
}
