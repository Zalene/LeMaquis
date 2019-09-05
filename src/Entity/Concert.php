<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ConcertRepository")
 */
class Concert
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $town;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Artiste", inversedBy="concerts")
     */
    private $artiste;

    public function __construct()
    {
        $this->artiste = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getTown(): ?string
    {
        return $this->town;
    }

    public function setTown(string $town): self
    {
        $this->town = $town;

        return $this;
    }

    /**
     * @return Collection|Artiste[]
     */
    public function getArtiste(): Collection
    {
        return $this->artiste;
    }

    public function addArtiste(Artiste $artiste): self
    {
        if (!$this->artiste->contains($artiste)) {
            $this->artiste[] = $artiste;
        }

        return $this;
    }

    public function removeArtiste(Artiste $artiste): self
    {
        if ($this->artiste->contains($artiste)) {
            $this->artiste->removeElement($artiste);
        }

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }
}
