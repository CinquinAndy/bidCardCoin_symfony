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


    public function __construct()
    {

    }

    public function __toString(){
        return (string)($this->getNom());
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
}
