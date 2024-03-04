<?php

namespace App\Entity;

use App\Repository\PiecesChangerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: PiecesChangerRepository::class)]
#[UniqueEntity('details')]
class PiecesChanger
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    #[Assert\Details(message:'Cette pièce a déjà été pris en compte')]
    #[Assert\NotBlank('Veuillez décrire la nouvelle')]
    private ?string $details = null;

    #[ORM\ManyToOne(inversedBy: 'piecesChangers')]
    #[Assert\NotBlank(message:'Veuillez selectionner une caracteristique')]
    private ?Caracteristiques $idCaracteristique = null;

    #[ORM\OneToMany(mappedBy: 'idPiece', targetEntity: Reparations::class)]
    private Collection $reparations;

    public function __construct()
    {
        $this->reparations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDetails(): ?string
    {
        return $this->details;
    }

    public function setDetails(string $details): static
    {
        $this->details = $details;

        return $this;
    }

    public function getIdCaracteristique(): ?Caracteristiques
    {
        return $this->idCaracteristique;
    }

    public function setIdCaracteristique(?Caracteristiques $idCaracteristique): static
    {
        $this->idCaracteristique = $idCaracteristique;

        return $this;
    }

    /**
     * @return Collection<int, Reparations>
     */
    public function getReparations(): Collection
    {
        return $this->reparations;
    }

    public function addReparation(Reparations $reparation): static
    {
        if (!$this->reparations->contains($reparation)) {
            $this->reparations->add($reparation);
            $reparation->setIdPiece($this);
        }

        return $this;
    }

    public function removeReparation(Reparations $reparation): static
    {
        if ($this->reparations->removeElement($reparation)) {
            // set the owning side to null (unless already changed)
            if ($reparation->getIdPiece() === $this) {
                $reparation->setIdPiece(null);
            }
        }

        return $this;
    }
}
