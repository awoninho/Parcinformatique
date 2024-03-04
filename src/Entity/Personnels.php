<?php

namespace App\Entity;

use App\Repository\PersonnelsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Misd\PhoneNumberBundle\Validator\Constraints as MisdAssert;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: PersonnelsRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'Ce collaborateur a déjà été enregistré')]
class Personnels implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    #[Assert\Email(
        message: 'L\'e-mail {{ value }} n\'est pas un e-mail valide.',
    )]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    #[Assert\Length(min: 8,
        message:'Votre mot de passe doit comporter au moins {{limit}} caractère'
    )]
    #[Assert\PasswordStrength([
        'message' => 'Votre mot de passe est trop faible. Veuillez utiliser un mot de passe plus fort.'
    ])]
    private ?string $password = null;

    #[ORM\Column(length: 100)]
    #[Assert\NotBlank(message:'Veuillez inserer votre nom')]
    #[Assert\Length(
        min: 3, max: 30, 
        MinMessage:'Votre nom doit comporter au moins {{limit}} caractères',
        MaxMessage:'Votre nom doit comporter au plus {{limit}} caractères'
        )]
    private ?string $nom = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $prenom = null;

    #[ORM\Column(length: 20)]
    #[Assert\Choice(['Masculin', 'Feminin'])]
    private ?string $sexe = null;

    #[ORM\Column(length: 50)]
    #[Assert\NotBlank(message:'Veuillez renseigner votre fonction')]
    #[Assert\Length(
        min: 3, max: 30, 
        MinMessage:'Votre fonction doit comporter au moins {{limit}} caractères',
        MaxMessage:'Votre fonction doit comporter au plus {{limit}} caractères'
        )]
    private ?string $fonction = null;

    #[ORM\Column(length: 15)]
    #[Assert\NotBlank(message:'Veuillez renseigner votre numéro de télephone')]
    #[MisdAssert\PhoneNumber(message:'Veuillez inserer un numéro de télephone valide')]
    private ?string $telephone = null;

    #[ORM\ManyToOne(inversedBy: 'personnels')]
    #[ORM\JoinColumn(nullable: false)]
    #[Assert\NotBlank('Veuillez renseigner le bureau de ce collaborateur')]
    private ?Emplacements $idEmplacement = null;

    #[ORM\OneToMany(mappedBy: 'idPersonne', targetEntity: Equipements::class)]
    private Collection $equipements;

    public function __construct()
    {
        $this->equipements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
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

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(?string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getSexe(): ?string
    {
        return $this->sexe;
    }

    public function setSexe(string $sexe): static
    {
        $this->sexe = $sexe;

        return $this;
    }

    public function getFonction(): ?string
    {
        return $this->fonction;
    }

    public function setFonction(string $fonction): static
    {
        $this->fonction = $fonction;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): static
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getIdEmplacement(): ?Emplacements
    {
        return $this->idEmplacement;
    }

    public function setIdEmplacement(?Emplacements $idEmplacement): static
    {
        $this->idEmplacement = $idEmplacement;

        return $this;
    }

    /**
     * @return Collection<int, Equipements>
     */
    public function getEquipements(): Collection
    {
        return $this->equipements;
    }

    public function addEquipement(Equipements $equipement): static
    {
        if (!$this->equipements->contains($equipement)) {
            $this->equipements->add($equipement);
            $equipement->setIdPersonne($this);
        }

        return $this;
    }

    public function removeEquipement(Equipements $equipement): static
    {
        if ($this->equipements->removeElement($equipement)) {
            // set the owning side to null (unless already changed)
            if ($equipement->getIdPersonne() === $this) {
                $equipement->setIdPersonne(null);
            }
        }

        return $this;
    }
}
