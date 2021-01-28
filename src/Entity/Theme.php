<?php

namespace App\Entity;

use App\Repository\ThemeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ThemeRepository::class)
 */
class Theme
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $color;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=Concept::class, mappedBy="theme")
     */
    private $concepts;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $textColor;

    public function __construct()
    {
        $this->concepts = new ArrayCollection();
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

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(string $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|Concept[]
     */
    public function getConcepts(): Collection
    {
        return $this->concepts;
    }

    public function addConcept(Concept $concept): self
    {
        if (!$this->concepts->contains($concept)) {
            $this->concepts[] = $concept;
            $concept->setTheme($this);
        }

        return $this;
    }

    public function removeConcept(Concept $concept): self
    {
        if ($this->concepts->removeElement($concept)) {
            // set the owning side to null (unless already changed)
            if ($concept->getTheme() === $this) {
                $concept->setTheme(null);
            }
        }

        return $this;
    }

    public function getTextColor(): ?string
    {
        return $this->textColor;
    }

    public function setTextColor(string $textColor): self
    {
        $this->textColor = $textColor;

        return $this;
    }
}
