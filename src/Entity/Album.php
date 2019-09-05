<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\Common\Collections\ArrayCollection;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AlbumRepository")
 * @Vich\Uploadable
 */
class Album
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
    private $title;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Artiste", inversedBy="albums")
     */
    private $artiste;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $img;

    /**
     * @Vich\UploadableField(mapping="albums_image", fileNameProperty="img")
     * @var File
     */
    private $imgFile;

    /**
     * @ORM\Column(type="datetime")
     * @var \DateTime|null
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $download;

    public function __construct()
    {
        $this->artiste = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getImg(): ?string
    {
        return $this->img;
    }

    public function setImg(?string $img): self
    {
        $this->img = $img;

        return $this;
    }

    public function getImgFile()
    {
        return $this->imgFile;
    }

    public function setImgFile(File $img = null)
    {
        $this->imgFile = $img;

        if ($img) {
            $this->updatedAt = new \DateTime('now');
        }
        
        return $this;
    }

    public function __toString()
    {
        return $this->title;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getDownload(): ?string
    {
        return $this->download;
    }

    public function setDownload(?string $download): self
    {
        $this->download = $download;

        return $this;
    }
}
