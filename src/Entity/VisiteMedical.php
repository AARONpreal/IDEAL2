<?php

namespace App\Entity;

use App\Repository\VisiteMedicalRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: VisiteMedicalRepository::class)]
class VisiteMedical
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'date')]
    #[Assert\NotBlank]
    private $dateVisite;

    #[ORM\Column(type: 'date', nullable: true)]
    private $prochaineVisite;

    #[ORM\Column(type: 'text', nullable: true)]
    private $resultats;

    #[ORM\Column(type: 'boolean')]
    private $aptitude = false;

    #[ORM\ManyToOne(targetEntity: Employe::class, inversedBy: 'visitesMedicales')]
    #[ORM\JoinColumn(nullable: false)]
    #[Assert\NotBlank]
    private $employe;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateVisite(): ?\DateTimeInterface
    {
        return $this->dateVisite;
    }

    public function setDateVisite(\DateTimeInterface $dateVisite): self
    {
        $this->dateVisite = $dateVisite;

        return $this;
    }

    public function getProchaineVisite(): ?\DateTimeInterface
    {
        return $this->prochaineVisite;
    }

    public function setProchaineVisite(?\DateTimeInterface $prochaineVisite): self
    {
        $this->prochaineVisite = $prochaineVisite;

        return $this;
    }

    public function getResultats(): ?string
    {
        return $this->resultats;
    }

    public function setResultats(?string $resultats): self
    {
        $this->resultats = $resultats;

        return $this;
    }

    public function getAptitude(): ?bool
    {
        return $this->aptitude;
    }

    public function setAptitude(bool $aptitude): self
    {
        $this->aptitude = $aptitude;

        return $this;
    }

    public function getEmploye(): ?Employe
    {
        return $this->employe;
    }

    public function setEmploye(?Employe $employe): self
    {
        $this->employe = $employe;

        return $this;
    }
}
