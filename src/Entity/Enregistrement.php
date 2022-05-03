<?php

namespace App\Entity;

use App\Repository\EnregistrementRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EnregistrementRepository::class)
 */
class Enregistrement
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $creePar;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $creeLe;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $modifiePar;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $modifieLe;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreePar(): ?string
    {
        return $this->creePar;
    }

    public function setCreePar(?string $creePar): self
    {
        $this->creePar = $creePar;

        return $this;
    }

    public function getCreeLe(): ?\DateTimeInterface
    {
        return $this->creeLe;
    }

    public function setCreeLe(?\DateTimeInterface $creeLe): self
    {
        $this->creeLe = $creeLe;

        return $this;
    }

    public function getModifiePar(): ?string
    {
        return $this->modifiePar;
    }

    public function setModifiePar(?string $modifiePar): self
    {
        $this->modifiePar = $modifiePar;

        return $this;
    }

    public function getModifieLe(): ?\DateTimeInterface
    {
        return $this->modifieLe;
    }

    public function setModifieLe(?\DateTimeInterface $modifieLe): self
    {
        $this->modifieLe = $modifieLe;

        return $this;
    }
}
