<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true, nullable=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $prenom;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $age;

    /**
     * @ORM\Column(type="string", length=255, nullable=true, nullable=true)
     */
    private $numeroMobile;

    /**
     * @ORM\Column(type="string", length=255, nullable=true, nullable=true)
     */
    private $numeroFixe;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $verifSolvabilite;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $verifIdentite;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $verifRessortissant;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $estCommissairePriseur;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $listeMotCle;

    /**
     * @ORM\ManyToMany(targetEntity=Adresse::class, mappedBy="user")
     */
    private $adresses;

    /**
     * @ORM\OneToMany(targetEntity=OrdreAchat::class, mappedBy="user")
     */
    private $ordreAchats;

    /**
     * @ORM\OneToMany(targetEntity=Paiement::class, mappedBy="user")
     */
    private $paiements;

    /**
     * @ORM\ManyToMany(targetEntity=Enchere::class, mappedBy="user")
     */
    private $encheres;

    /**
     * @ORM\ManyToMany(targetEntity=Lot::class, mappedBy="user")
     */
    private $lots;

    public function __construct()
    {
        $this->adresses = new ArrayCollection();
        $this->encheres = new ArrayCollection();

        $this->ordreAchats = new ArrayCollection();
        $this->paiements = new ArrayCollection();
        $this->lots = new ArrayCollection();

    }

    public function __toString(){
        return (string)('id: ' . $this->getId() .
            '|| email: ' . $this->getEmail() .
            '|| username: ' . $this->getUsername() .
//            '|| password: ' . $this->getPassword() .
            '|| nom: ' . $this->getNom() .
            '|| prenom: ' . $this->getPrenom() .
            '|| age: ' . $this->getAge() .
            '|| numeroMobile: ' . $this->getNumeroMobile() .
            '|| numeroFixe: ' . $this->getNumeroFixe() .
            '|| verifSolvabilite: ' . $this->getVerifSolvabilite() .
            '|| verifIdentite: ' . $this->getVerifIdentite() .
            '|| verifRessortissant: ' . $this->getVerifRessortissant() .
            '|| estCommissairePriseur: ' . $this->getEstCommissairePriseur() .
            '|| listeMotCle: ' . $this->getListeMotCle());
            //'|| salt: ' . $this->getSalt() .
            //'|| adresses: ' . $this->getAdresses()->__toString() .
            //'|| encheres: ' . $this->getEncheres()->__toString() .
            //'|| ordreAchats: ' . $this->getOrdreAchats()->__toString() .
            //'|| paiements: ' . $this->getPaiements()->__toString() .
            //'|| lots: ' . $this->getLots()->__toString());
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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

    /**
     * @return Collection|Adresse[]
     */
    public function getAdresses(): Collection
    {
        return $this->adresses;
    }

    public function addAdress(Adresse $adress): self
    {
        if (!$this->adresses->contains($adress)) {
            $this->adresses[] = $adress;
            $adress->addUser($this);
        }

        return $this;
    }

    public function removeAdress(Adresse $adress): self
    {
        if ($this->adresses->removeElement($adress)) {
            $adress->removeUser($this);
        }

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
            $enchere->addUserAdjuge($this);
        }

        return $this;
    }

    public function removeEnchere(Enchere $enchere): self
    {
        if ($this->encheres->removeElement($enchere)) {
            $enchere->removeUserAdjuge($this);
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
            $ordreAchat->setUser($this);
        }

        return $this;
    }

    public function removeOrdreAchat(OrdreAchat $ordreAchat): self
    {
        if ($this->ordreAchats->removeElement($ordreAchat)) {
            // set the owning side to null (unless already changed)
            if ($ordreAchat->getUser() === $this) {
                $ordreAchat->setUser(null);
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
            $paiement->setUser($this);
        }

        return $this;
    }

    public function removePaiement(Paiement $paiement): self
    {
        if ($this->paiements->removeElement($paiement)) {
            // set the owning side to null (unless already changed)
            if ($paiement->getUser() === $this) {
                $paiement->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Lot[]
     */
    public function getLots(): Collection
    {
        return $this->lots;
    }

    public function addLot(Lot $lot): self
    {
        if (!$this->lots->contains($lot)) {
            $this->lots[] = $lot;
            $lot->addUser($this);
        }

        return $this;
    }

    public function removeLot(Lot $lot): self
    {
        if ($this->lots->removeElement($lot)) {
            $lot->removeUser($this);
        }

        return $this;
    }
}
