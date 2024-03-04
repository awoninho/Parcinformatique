<?php

namespace App\Entity;

use App\Repository\CaracteristiquesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CaracteristiquesRepository::class)]
#[UniqueEntity('libelle')]
class Caracteristiques
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    #[Assert\NotBlank(message:'Veuillez inserer une caracteristique')]
    #[Assert\Length(
        min: 10, max: 100, 
        MinMessage:'Votre caractéristique doit comporter au moins {{limit}} caractères',
        MaxMessage:'Vos caractéristiques doivent s\'étendre sur au plus {{limit}} caractères'
        )]
    #[Assert\Libelle(message:'Cette caractéristique a déjà été enregistré')]
    private ?string $libelle = null;

    #[ORM\ManyToOne(inversedBy: 'caracteristiques')]
    #[ORM\JoinColumn(nullable: false)]
    #[Assert\NotBlank(message:'Veuillez designer un type ')]
    private ?TypeMateriels $idType = null;

    #[ORM\OneToMany(mappedBy: 'idCaracteristique', targetEntity: PiecesChanger::class)]
    private Collection $piecesChangers;

    public function __construct()
    {
        $this->piecesChangers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): static
    {
        $this->libelle = $libelle;

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

    /**
     * @return Collection<int, PiecesChanger>
     */
    public function getPiecesChangers(): Collection
    {
        return $this->piecesChangers;
    }

    public function addPiecesChanger(PiecesChanger $piecesChanger): static
    {
        if (!$this->piecesChangers->contains($piecesChanger)) {
            $this->piecesChangers->add($piecesChanger);
            $piecesChanger->setIdCaracteristique($this);
        }

        return $this;
    }

    public function removePiecesChanger(PiecesChanger $piecesChanger): static
    {
        if ($this->piecesChangers->removeElement($piecesChanger)) {
            // set the owning side to null (unless already changed)
            if ($piecesChanger->getIdCaracteristique() === $this) {
                $piecesChanger->setIdCaracteristique(null);
            }
        }

        return $this;
    }
}
