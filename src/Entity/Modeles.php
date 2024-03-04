<?php

namespace App\Entity;

use App\Repository\ModelesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: ModelesRepository::class)]
#[UniqueEntity('libelle')]
class Modeles
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    #[Assert\NotBlank(message:'Veuillez renseigner le modèle')]
    #[Assert\Length(
        min: 3, max: 10, 
        MinMessage:'Le modèle doit comporter au moins {{limit}} caractères',
        MaxMessage:'Le modèle doit comporter au plus {{limit}} caractères'
        )]
    #[Assert\Libelle(message:'Le modèle renseigner a déjà été enregistrée')]
    private ?string $libelle = null;

    #[ORM\OneToMany(mappedBy: 'idModele', targetEntity: Equipements::class)]
    private Collection $equipements;

    public function __construct()
    {
        $this->equipements = new ArrayCollection();
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
            $equipement->setIdModele($this);
        }

        return $this;
    }

    public function removeEquipement(Equipements $equipement): static
    {
        if ($this->equipements->removeElement($equipement)) {
            // set the owning side to null (unless already changed)
            if ($equipement->getIdModele() === $this) {
                $equipement->setIdModele(null);
            }
        }

        return $this;
    }
}
