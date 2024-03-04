<?php

namespace App\Entity;

use App\Repository\EmplacementsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: EmplacementsRepository::class)]
#[UniqueEntity('bureau')]
class Emplacements
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 60)]
    #[Assert\NotBlank(message:'veuillez designer votre salle')]
    #[Assert\Length(
    min: 3, max: 30, 
    MinMessage:'La designation de votre salle doit comporter au moins {{limit}} caractères',
    MaxMessage:'La designation de votre salle doit comporter au plus {{limit}} caractères'
    )]
    private ?string $salle = null;

    #[ORM\Column(length: 20, nullable: true)]
    #[Assert\NotBlank(message:'Veuillez renseigner le code de votre bureau')]
    #[Assert\Length(
        min: 3, max: 10, 
        MinMessage:'Le code de votre bureau doit comporter au moins {{limit}} caractères',
        MaxMessage:'Le code de votre bureau doit comporter au plus {{limit}} caractères'
        )]
    #[Assert\Bureau(message:'Ce bureau existe déjà')]
    private ?string $bureau = null;

    #[ORM\OneToMany(mappedBy: 'idEmplacement', targetEntity: Personnels::class)]
    private Collection $personnels;

    public function __construct()
    {
        $this->personnels = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSalle(): ?string
    {
        return $this->salle;
    }

    public function setSalle(string $salle): static
    {
        $this->salle = $salle;

        return $this;
    }

    public function getBureau(): ?string
    {
        return $this->bureau;
    }

    public function setBureau(?string $bureau): static
    {
        $this->bureau = $bureau;

        return $this;
    }

    /**
     * @return Collection<int, Personnels>
     */
    public function getPersonnels(): Collection
    {
        return $this->personnels;
    }

    public function addPersonnel(Personnels $personnel): static
    {
        if (!$this->personnels->contains($personnel)) {
            $this->personnels->add($personnel);
            $personnel->setIdEmplacement($this);
        }

        return $this;
    }

    public function removePersonnel(Personnels $personnel): static
    {
        if ($this->personnels->removeElement($personnel)) {
            // set the owning side to null (unless already changed)
            if ($personnel->getIdEmplacement() === $this) {
                $personnel->setIdEmplacement(null);
            }
        }

        return $this;
    }    
}
