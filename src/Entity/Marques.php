<?php

namespace App\Entity;

use App\Repository\MarquesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


#[ORM\Entity(repositoryClass: MarquesRepository::class)]
#[UniqueEntity('libelle')]
class Marques
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    #[Assert\NotBlank(message:'Veuillez renseigner une marque')]
    #[Assert\Libelle(message:'La marque renseignée a déjà été enregistrée')]
    #[Assert\Length(
        min: 3, max: 20, 
        MinMessage:'Votre marque doit comporter au moins {{limit}} caractères',
        MaxMessage:'Votre marque doit comporter au plus {{limit}} caractères'
        )]
    private ?string $libelle = null;

    #[ORM\OneToMany(mappedBy: 'idMarque', targetEntity: Equipements::class)]
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
            $equipement->setIdMarque($this);
        }

        return $this;
    }

    public function removeEquipement(Equipements $equipement): static
    {
        if ($this->equipements->removeElement($equipement)) {
            // set the owning side to null (unless already changed)
            if ($equipement->getIdMarque() === $this) {
                $equipement->setIdMarque(null);
            }
        }

        return $this;
    }
}
