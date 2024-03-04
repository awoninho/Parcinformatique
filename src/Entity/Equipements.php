<?php

namespace App\Entity;

use App\Repository\EquipementsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: EquipementsRepository::class)]
class Equipements
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100, nullable: true)]
    #[Assert\Length(
        max: 30,
        MaxMessage:'Le numéro de serie ne peut comporter au plus {{limit}} caractères'
    )]
    private ?string $numeroSerie = null;

    #[ORM\Column(length: 20)]
    #[Assert\NotBlank(message:'Veuillez renseigner l\'état de votre équipement')]
    #[Assert\Choice(['Bon', 'Vetuste', 'Mauvais'])]
    private ?string $sonEtat = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    /**
     * @var string A "d-m-Y" formatted value
     */
    #[Assert\Date]
    #[Assert\NotBlank(message:'Veuillez inserer la date d\'acquisition de votre équipement')]
    private ?\DateTimeInterface $dateAcquisition = null;

    #[ORM\ManyToOne(inversedBy: 'equipements')]
    #[ORM\JoinColumn(nullable: false)]
    #[Assert\NotBlank(message:'Veuillez selectionner la marque de votre équipement')]
    private ?Marques $idMarque = null;

    #[ORM\ManyToOne(inversedBy: 'equipements')]
    private ?Modeles $idModele = null;

    #[ORM\ManyToOne(inversedBy: 'equipements')]
    #[ORM\JoinColumn(nullable: false)]
    #[Assert\NotBlank(message:'Veuillez designer le type de votre équipement')]
    private ?TypeMateriels $idType = null;

    #[ORM\ManyToOne(inversedBy: 'equipements')]
    #[ORM\JoinColumn(nullable: false)]
    #[Assert\NotBlank(message:'Veuillez inserer le nom du collaborateur en charge de cet équipement')]
    private ?Personnels $idPersonne = null;

    #[ORM\OneToMany(mappedBy: 'idEquipement', targetEntity: Pannes::class)]
    private Collection $pannes;

    public function __construct()
    {
        $this->pannes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumeroSerie(): ?string
    {
        return $this->numeroSerie;
    }

    public function setNumeroSerie(?string $numeroSerie): static
    {
        $this->numeroSerie = $numeroSerie;

        return $this;
    }

    public function getSonEtat(): ?string
    {
        return $this->sonEtat;
    }

    public function setSonEtat(string $sonEtat): static
    {
        $this->sonEtat = $sonEtat;

        return $this;
    }

    public function getDateAcquisition(): ?\DateTimeInterface
    {
        return $this->dateAcquisition;
    }

    public function setDateAcquisition(\DateTimeInterface $dateAcquisition): static
    {
        $this->dateAcquisition = $dateAcquisition;

        return $this;
    }

    public function getIdMarque(): ?Marques
    {
        return $this->idMarque;
    }

    public function setIdMarque(?Marques $idMarque): static
    {
        $this->idMarque = $idMarque;

        return $this;
    }

    public function getIdModele(): ?Modeles
    {
        return $this->idModele;
    }

    public function setIdModele(?Modeles $idModele): static
    {
        $this->idModele = $idModele;

        return $this;
    }

    public function getIdType(): ?TypeMateriels
    {
        return $this->idType;
    }

    public function setIdType(?TypeMateriels $idType): static
    {
        $this->idType = $idType;

        return $this;
    }

    public function getIdPersonne(): ?Personnels
    {
        return $this->idPersonne;
    }

    public function setIdPersonne(?Personnels $idPersonne): static
    {
        $this->idPersonne = $idPersonne;

        return $this;
    }

    /**
     * @return Collection<int, Pannes>
     */
    public function getPannes(): Collection
    {
        return $this->pannes;
    }

    public function addPanne(Pannes $panne): static
    {
        if (!$this->pannes->contains($panne)) {
            $this->pannes->add($panne);
            $panne->setIdEquipement($this);
        }

        return $this;
    }

    public function removePanne(Pannes $panne): static
    {
        if ($this->pannes->removeElement($panne)) {
            // set the owning side to null (unless already changed)
            if ($panne->getIdEquipement() === $this) {
                $panne->setIdEquipement(null);
            }
        }

        return $this;
    }
}
