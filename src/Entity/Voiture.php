<?php

namespace App\Entity;

use App\Repository\VoitureRepository;
 use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VoitureRepository::class)
 */
class Voiture
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $marque;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $modele;

    /**
     * @ORM\Column(type="integer")
     */
    private $numero_identifiant;

    /**
     * @ORM\Column(type="integer")
     */
    private $numero_serie;

    /**
     * @ORM\Column(type="date")
     */     
    private $date_achat;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $couleur;

    /**
     * @ORM\OneToOne(targetEntity=Vente::class, mappedBy="voiture", cascade={"persist", "remove"})
     */
    private $vente;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMarque(): ?string
    {
        return $this->marque;
    }

    public function setMarque(string $marque): self
    {
        $this->marque = $marque;

        return $this;
    }

    public function getModele(): ?string
    {
        return $this->modele;
    }

    public function setModele(string $modele): self
    {
        $this->modele = $modele;

        return $this;
    }

    public function getNumeroIdentifiant(): ?int
    {
        return $this->numero_identifiant;
    }

    public function setNumeroIdentifiant(int $numero_identifiant): self
    {
        $this->numero_identifiant = $numero_identifiant;

        return $this;
    }

    public function getNumeroSerie(): ?int
    {
        return $this->numero_serie;
    }

    public function setNumeroSerie(int $numero_serie): self
    {
        $this->numero_serie = $numero_serie;

        return $this;
    }

    public function getDateAchat(): ?\DateTimeInterface
    {
        return $this->date_achat;
    }

    public function setDateAchat(\DateTimeInterface $date_achat): self
    {
        $this->date_achat = $date_achat;

        return $this;
    }

    public function getCouleur(): ?string
    {
        return $this->couleur;
    }

    public function setCouleur(string $couleur): self
    {
        $this->couleur = $couleur;

        return $this;
    }

    public function getVente(): ?Vente
    {
        return $this->vente;
    }

    public function setVente(Vente $vente): self
    {
        // set the owning side of the relation if necessary
        if ($vente->getVoiture() !== $this) {
            $vente->setVoiture($this);
        }

        $this->vente = $vente;

        return $this;
    }

    public function __toString(){
        return $this->numero_serie;
    }
}
