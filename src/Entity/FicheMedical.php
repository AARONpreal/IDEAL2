<?php

namespace App\Entity;

use App\Repository\FicheMedicalRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: FicheMedicalRepository::class)]
class FicheMedical
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 50, unique: true)]
    #[Assert\NotBlank]
    #[Assert\Length(max: 50)]
    private $numeroDossier;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank]
    #[Assert\Length(max: 255)]
    private $nom;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank]
    #[Assert\Length(max: 255)]
    private $prenom;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Assert\Length(max: 255)]
    private $nomJeuneFille;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Assert\Length(max: 255)]
    private $nee;

    #[ORM\Column(type: 'text', nullable: true)]
    private $adresse;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    #[Assert\Length(max: 50)]
    private $telephone;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Assert\Length(max: 255)]
    private $personneAContacter;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank]
    #[Assert\Length(max: 255)]
    private $profession;

    #[ORM\Column(type: 'string', length: 10, nullable: true)]
    private $groupeSanguinRhesus;

    #[ORM\Column(type: 'text', nullable: true)]
    private $allergie;

    #[ORM\Column(type: 'text', nullable: true)]
    private $antecedentsFamiliaux;

    #[ORM\Column(type: 'text', nullable: true)]
    private $antecedentsPersonnels;

    #[ORM\Column(type: 'text', nullable: true)]
    private $correspondantsMedicaux;

    #[ORM\Column(type: 'date', nullable: true)]
    private $date;

    #[ORM\Column(type: 'text', nullable: true)]
    private $diagnostic;

    #[ORM\Column(type: 'text', nullable: true)]
    private $conduiteAvenir;

    #[ORM\OneToOne(targetEntity: Employe::class, inversedBy: 'ficheMedical', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    #[Assert\NotBlank]
    private $employe;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumeroDossier(): ?string
    {
        return $this->numeroDossier;
    }

    public function setNumeroDossier(string $numeroDossier): self
    {
        $this->numeroDossier = $numeroDossier;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getNomJeuneFille(): ?string
    {
        return $this->nomJeuneFille;
    }

    public function setNomJeuneFille(?string $nomJeuneFille): self
    {
        $this->nomJeuneFille = $nomJeuneFille;

        return $this;
    }

    public function getNee(): ?string
    {
        return $this->nee;
    }

    public function setNee(?string $nee): self
    {
        $this->nee = $nee;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(?string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getPersonneAContacter(): ?string
    {
        return $this->personneAContacter;
    }

    public function setPersonneAContacter(?string $personneAContacter): self
    {
        $this->personneAContacter = $personneAContacter;

        return $this;
    }

    public function getProfession(): ?string
    {
        return $this->profession;
    }

    public function setProfession(string $profession): self
    {
        $this->profession = $profession;

        return $this;
    }

    public function getGroupeSanguinRhesus(): ?string
    {
        return $this->groupeSanguinRhesus;
    }

    public function setGroupeSanguinRhesus(?string $groupeSanguinRhesus): self
    {
        $this->groupeSanguinRhesus = $groupeSanguinRhesus;

        return $this;
    }

    public function getAllergie(): ?string
    {
        return $this->allergie;
    }

    public function setAllergie(?string $allergie): self
    {
        $this->allergie = $allergie;

        return $this;
    }

    public function getAntecedentsFamiliaux(): ?string
    {
        return $this->antecedentsFamiliaux;
    }

    public function setAntecedentsFamiliaux(?string $antecedentsFamiliaux): self
    {
        $this->antecedentsFamiliaux = $antecedentsFamiliaux;

        return $this;
    }

    public function getAntecedentsPersonnels(): ?string
    {
        return $this->antecedentsPersonnels;
    }

    public function setAntecedentsPersonnels(?string $antecedentsPersonnels): self
    {
        $this->antecedentsPersonnels = $antecedentsPersonnels;

        return $this;
    }

    public function getCorrespondantsMedicaux(): ?string
    {
        return $this->correspondantsMedicaux;
    }

    public function setCorrespondantsMedicaux(?string $correspondantsMedicaux): self
    {
        $this->correspondantsMedicaux = $correspondantsMedicaux;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getDiagnostic(): ?string
    {
        return $this->diagnostic;
    }

    public function setDiagnostic(?string $diagnostic): self
    {
        $this->diagnostic = $diagnostic;

        return $this;
    }

    public function getConduiteAvenir(): ?string
    {
        return $this->conduiteAvenir;
    }

    public function setConduiteAvenir(?string $conduiteAvenir): self
    {
        $this->conduiteAvenir = $conduiteAvenir;

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
