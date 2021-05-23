<?php

namespace App\Entity;

use App\Repository\EnchereRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EnchereRepository::class)
 */
class Enchere
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
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

    /**
     * @ORM\ManyToOne(targetEntity=Lot::class, inversedBy="encheres")
     */
    private $lot;

    /**
     * @ORM\ManyToOne(targetEntity=Vente::class, inversedBy="encheres")
     */
    private $vente;


    /**
     * @ORM\OneToMany(targetEntity=OrdreAchat::class, mappedBy="enchere")
     */
    private $ordreAchat;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, inversedBy="encheres")
     */
    private $user;

    public function __construct()
    {
        $this->ordreAchat = new ArrayCollection();
        $this->user = new ArrayCollection();
    }

    public function __toString()
    {
        return (string)('id: ' . $this->getId() .
            '|| prixProposer: ' . $this->getPrixProposer() .
            '|| estAdjuger: ' . $this->getEstAdjuger() .
            '|| dateHeureVente: ' . $this->getDateHeureVente()->__toString());
        //'|| lot: ' . $this->getLot()->__toString() .
        //'|| vente: ' . $this->getVente()->__toString() .
        //'|| ordreAchat: ' . $this->getOrdreAchat()->__toString() .
        //'|| user: ' . $this->getUser()->__toString());
    }

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

    public function getLot(): ?Lot
    {
        return $this->lot;
    }

    public function setLot(?Lot $lot): self
    {
        $this->lot = $lot;

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
     * @return Collection|OrdreAchat[]
     */
    public function getOrdreAchat(): Collection
    {
        return $this->ordreAchat;
    }

    public function addOrdreAchat(OrdreAchat $ordreAchat): self
    {
        if (!$this->ordreAchat->contains($ordreAchat)) {
            $this->ordreAchat[] = $ordreAchat;
            $ordreAchat->setEnchere($this);
        }

        return $this;
    }

    public function removeOrdreAchat(OrdreAchat $ordreAchat): self
    {
        if ($this->ordreAchat->removeElement($ordreAchat)) {
            // set the owning side to null (unless already changed)
            if ($ordreAchat->getEnchere() === $this) {
                $ordreAchat->setEnchere(null);
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
}
