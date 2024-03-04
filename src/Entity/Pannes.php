<?php

namespace App\Entity;

use App\Repository\PannesRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: PannesRepository::class)]
class Pannes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    #[Assert\NotBlank(message:'Veuillez donner votre dignostique')]
    #[Assert\Length(
        min: 10, max: 100, 
        MinMessage:'Votre diagnostique doit s\'étendre sur au moins {{limit}} caractères',
        MaxMessage:'Vos diagnostique doit s\'étendre sur au plus {{limit}} caractères'
        )]
    private ?string $diagnostic = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    /**
     * @var string A "d-m-Y" formatted value
     */
    #[Assert\Date]
    #[Assert\NotBlank(message:'Veuillez inserer la date à laquelle la panne a été déclarée')]
    private ?\DateTimeInterface $datePanne = null;

    #[ORM\ManyToOne(inversedBy: 'pannes')]
    #[ORM\JoinColumn(nullable: false)]
    #[Assert\NotBlank(message:'Veuillez selectionner un équipement')]
    private ?Equipements $idEquipement = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDiagnostic(): ?string
    {
        return $this->diagnostic;
    }

    public function setDiagnostic(string $diagnostic): static
    {
        $this->diagnostic = $diagnostic;

        return $this;
    }

    public function getDatePanne(): ?\DateTimeInterface
    {
        return $this->datePanne;
    }

    public function setDatePanne(\DateTimeInterface $datePanne): static
    {
        $this->datePanne = $datePanne;

        return $this;
    }

    public function getIdEquipement(): ?Equipements
    {
        return $this->idEquipement;
    }

    public function setIdEquipement(?Equipements $idEquipement): static
    {
        $this->idEquipement = $idEquipement;

        return $this;
    }
}
