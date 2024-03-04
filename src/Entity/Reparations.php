<?php

namespace App\Entity;

use App\Repository\ReparationsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: ReparationsRepository::class)]
class Reparations
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    /**
     * @var string A "d-m-Y" formatted value
     */
    #[Assert\Date]
    #[Assert\NotBlank(message:'Veuillez inserer la date de reparation')]
    private ?\DateTimeInterface $dateReparation = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $commentaire = null;

    #[ORM\ManyToOne(inversedBy: 'reparations')]
    private ?PiecesChanger $idPiece = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateReparation(): ?\DateTimeInterface
    {
        return $this->dateReparation;
    }

    public function setDateReparation(\DateTimeInterface $dateReparation): static
    {
        $this->dateReparation = $dateReparation;

        return $this;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(?string $commentaire): static
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    public function getIdPiece(): ?PiecesChanger
    {
        return $this->idPiece;
    }

    public function setIdPiece(?PiecesChanger $idPiece): static
    {
        $this->idPiece = $idPiece;

        return $this;
    }
}
