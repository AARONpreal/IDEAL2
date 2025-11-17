<?php

namespace App\Entity;

use App\Repository\EmployeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: EmployeRepository::class)]
class Employe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank]
    #[Assert\Length(min: 2, max: 255)]
    private $nom;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank]
    #[Assert\Length(min: 2, max: 255)]
    private $prenom;

    #[ORM\Column(type: 'date')]
    #[Assert\NotBlank]
    private $dateEntree;

    #[ORM\Column(type: 'string', length: 50, unique: true)]
    #[Assert\NotBlank]
    #[Assert\Length(max: 50)]
    private $matricule = null;
    public function generateMatricule(): void
    {
        if ($this->matricule === null) {
            // Génère un matricule du type EMP-2025-XXXX (numéro aléatoire)
            $this->matricule = 'EMP-' . date('Y') . '-' . str_pad(random_int(1, 9999), 4, '0', STR_PAD_LEFT);
        }
    }
    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    #[Assert\Length(max: 50)]
    private $numeroCnps;

    #[ORM\Column(type: 'string', length: 50)]
    #[Assert\NotBlank]
    #[Assert\Choice(['CDI', 'CDD'])]
    private $categorieContrat;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    #[Assert\Length(max: 50)]
    private $situationMatrimoniale;

    #[ORM\Column(type: 'date', nullable: true)]
    private $dateNaissance;

    #[ORM\Column(type: 'integer', nullable: true)]
    #[Assert\Range(min: 16, max: 100)]
    private $age;

    #[ORM\Column(type: 'string', length: 20, nullable: true)]
    #[Assert\Choice(['Masculin', 'Féminin', ''])]
    private $genre;

    #[ORM\Column(type: 'string', length: 10, nullable: true)]
    private $groupeSanguin;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Assert\Length(max: 255)]
    private $contact;

    #[ORM\ManyToOne(targetEntity: Departement::class)]
    #[ORM\JoinColumn(nullable: false)]
    #[Assert\NotBlank]
    private $departement;

    #[ORM\ManyToOne(targetEntity: Service::class)]
    #[ORM\JoinColumn(nullable: false)]
    #[Assert\NotBlank]
    private $service;

    #[ORM\ManyToOne(targetEntity: Fonction::class)]
    #[ORM\JoinColumn(nullable: false)]
    #[Assert\NotBlank]
    private $fonction;

    #[ORM\OneToMany(mappedBy: 'employe', targetEntity: Contrat::class, cascade: ['persist', 'remove'])]
    private $contrats;

    #[ORM\OneToMany(mappedBy: 'employe', targetEntity: VisiteMedical::class, cascade: ['persist', 'remove'])]
    private $visitesMedicales;

    #[ORM\OneToOne(mappedBy: 'employe', targetEntity: FicheMedical::class, cascade: ['persist', 'remove'])]
    private $ficheMedical;

    public function __construct()
    {
        $this->contrats = new ArrayCollection();
        $this->visitesMedicales = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDateEntree(): ?\DateTimeInterface
    {
        return $this->dateEntree;
    }

    public function setDateEntree(\DateTimeInterface $dateEntree): self
    {
        $this->dateEntree = $dateEntree;

        return $this;
    }

    public function getMatricule(): ?string
    {
        return $this->matricule;
    }

    public function setMatricule(string $matricule): self
    {
        $this->matricule = $matricule;

        return $this;
    }

    public function getNumeroCnps(): ?string
    {
        return $this->numeroCnps;
    }

    public function setNumeroCnps(?string $numeroCnps): self
    {
        $this->numeroCnps = $numeroCnps;

        return $this;
    }

    public function getCategorieContrat(): ?string
    {
        return $this->categorieContrat;
    }

    public function setCategorieContrat(string $categorieContrat): self
    {
        $this->categorieContrat = $categorieContrat;

        return $this;
    }

    public function getSituationMatrimoniale(): ?string
    {
        return $this->situationMatrimoniale;
    }

    public function setSituationMatrimoniale(?string $situationMatrimoniale): self
    {
        $this->situationMatrimoniale = $situationMatrimoniale;

        return $this;
    }

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->dateNaissance;
    }

    public function setDateNaissance(?\DateTimeInterface $dateNaissance): self
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(?int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(?string $genre): self
    {
        $this->genre = $genre;

        return $this;
    }

    public function getGroupeSanguin(): ?string
    {
        return $this->groupeSanguin;
    }

    public function setGroupeSanguin(?string $groupeSanguin): self
    {
        $this->groupeSanguin = $groupeSanguin;

        return $this;
    }

    public function getContact(): ?string
    {
        return $this->contact;
    }

    public function setContact(?string $contact): self
    {
        $this->contact = $contact;

        return $this;
    }

    public function getDepartement(): ?Departement
    {
        return $this->departement;
    }

    public function setDepartement(?Departement $departement): self
    {
        $this->departement = $departement;

        return $this;
    }

    public function getService(): ?Service
    {
        return $this->service;
    }

    public function setService(?Service $service): self
    {
        $this->service = $service;

        return $this;
    }

    public function getFonction(): ?Fonction
    {
        return $this->fonction;
    }

    public function setFonction(?Fonction $fonction): self
    {
        $this->fonction = $fonction;

        return $this;
    }

    /**
     * @return Collection|Contrat[]
     */
    public function getContrats(): Collection
    {
        return $this->contrats;
    }

    public function addContrat(Contrat $contrat): self
    {
        if (!$this->contrats->contains($contrat)) {
            $this->contrats[] = $contrat;
            $contrat->setEmploye($this);
        }

        return $this;
    }

    public function removeContrat(Contrat $contrat): self
    {
        if ($this->contrats->removeElement($contrat)) {
            // set the owning side to null (unless already changed)
            if ($contrat->getEmploye() === $this) {
                $contrat->setEmploye(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|VisiteMedical[]
     */
    public function getVisitesMedicales(): Collection
    {
        return $this->visitesMedicales;
    }

    public function addVisitesMedical(VisiteMedical $visitesMedical): self
    {
        if (!$this->visitesMedicales->contains($visitesMedical)) {
            $this->visitesMedicales[] = $visitesMedical;
            $visitesMedical->setEmploye($this);
        }

        return $this;
    }

    public function removeVisitesMedical(VisiteMedical $visitesMedical): self
    {
        if ($this->visitesMedicales->removeElement($visitesMedical)) {
            // set the owning side to null (unless already changed)
            if ($visitesMedical->getEmploye() === $this) {
                $visitesMedical->setEmploye(null);
            }
        }

        return $this;
    }

    public function getFicheMedical(): ?FicheMedical
    {
        return $this->ficheMedical;
    }

    public function setFicheMedical(?FicheMedical $ficheMedical): self
    {
        // set (or unset) the owning side of the relation if necessary
        $newEmploye = $ficheMedical === null ? null : $this;
        if ($newEmploye !== $ficheMedical->getEmploye()) {
            $ficheMedical->setEmploye($newEmploye);
        }

        $this->ficheMedical = $ficheMedical;

        return $this;
    }

    public function __toString(): string
    {
        return $this->nom . ' ' . $this->prenom;
    }
}
