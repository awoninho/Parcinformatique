<?php

namespace App\Entity;

use App\Repository\TypeMaterielsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: TypeMaterielsRepository::class)]
#[UniqueEntity('libelle')]
class TypeMateriels
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    #[Assert\Libelle(message:'Ce type de materiel a déjà été enregistré')]
    #[Assert\NotBlank(message:'Veuillez inserer un nouveau type de materiel')]
    private ?string $libelle = null;

    #[ORM\OneToMany(mappedBy: 'idType', targetEntity: Caracteristiques::class)]
    private Collection $caracteristiques;

    #[ORM\OneToMany(mappedBy: 'idType', targetEntity: Equipements::class)]
    private Collection $equipements;

    public function __construct()
    {
        $this->equipements = new ArrayCollection();
        $this->caracteristiques = new ArrayCollection();
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

     /*public function getIdCaracteristique(): ?Caracteristiques
    {
        return $this->idCaracteristique;
    }

   public function setIdCaracteristique(?Caracteristiques $idCaracteristique): static
    {
        $this->idCaracteristique = $idCaracteristique;

        return $this;
    }*/

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
            $equipement->setIdType($this);
        }

        return $this;
    }

    public function removeEquipement(Equipements $equipement): static
    {
        if ($this->equipements->removeElement($equipement)) {
            // set the owning side to null (unless already changed)
            if ($equipement->getIdType() === $this) {
                $equipement->setIdType(null);
            }
        }

        return $this;
    }

    //Pour caracteristique

    /**
     * @return Collection<int, Caracteristiques>
     */
    public function getCaracteristiques(): Collection
    {
        return $this->caracteristiques;
    }

    public function addCaracteristique(Caracteristiques $caracteristique): static
    {
        if (!$this->caracteristiques->contains($caracteristique)) {
            $this->caracteristiques->add($caracteristique);
            $caracteristique->setIdType($this);
        }

        return $this;
    }

    public function removeCaracteristique(Caracteristiques $caracteristique): static
    {
        if ($this->equipements->removeElement($caracteristique)) {
            // set the owning side to null (unless already changed)
            if ($caracteristique->getIdType() === $this) {
                $caracteristique->setIdType(null);
            }
        }

        return $this;
    }
}
