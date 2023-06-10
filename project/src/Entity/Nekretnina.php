<?php

namespace App\Entity;

use App\Repository\NekretninaRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NekretninaRepository::class)]
class Nekretnina
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $naslov = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $opis = null;

    #[ORM\Column]
    private ?float $cijena = null;

    #[ORM\Column(length: 100)]
    private ?string $kategorija = null;

    #[ORM\Column(type: 'string')]
    private $filename;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNaslov(): ?string
    {
        return $this->naslov;
    }

    public function setNaslov(string $naslov): static
    {
        $this->naslov = $naslov;

        return $this;
    }

    public function getOpis(): ?string
    {
        return $this->opis;
    }

    public function setOpis(?string $opis): static
    {
        $this->opis = $opis;

        return $this;
    }

    public function getCijena(): ?float
    {
        return $this->cijena;
    }

    public function setCijena(float $cijena): static
    {
        $this->cijena = $cijena;

        return $this;
    }

    public function getKategorija(): ?string
    {
        return $this->kategorija;
    }

    public function setKategorija(string $kategorija): static
    {
        $this->kategorija = $kategorija;

        return $this;
    }

    public function getFilename(): string
    {
        return $this->filename;
    }

    public function setFilename(string $filename): self
    {
        $this->filename = $filename;

        return $this;
    }
}
