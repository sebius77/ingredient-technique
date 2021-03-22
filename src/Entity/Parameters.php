<?php

namespace App\Entity;

use App\Repository\ParametersRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ParametersRepository::class)
 */
class Parameters
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
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $presentationText;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $referenceList;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $footerText;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $toDoList;

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

    public function getPresentationText(): ?string
    {
        return $this->presentationText;
    }

    public function setPresentationText(?string $presentationText): self
    {
        $this->presentationText = $presentationText;

        return $this;
    }

    public function getReferenceList(): ?string
    {
        return $this->referenceList;
    }

    public function setReferenceList(?string $referenceList): self
    {
        $this->referenceList = $referenceList;

        return $this;
    }

    public function getFooterText(): ?string
    {
        return $this->footerText;
    }

    public function setFooterText(?string $footerText): self
    {
        $this->footerText = $footerText;

        return $this;
    }

    public function getToDoList(): ?string
    {
        return $this->toDoList;
    }

    public function setToDoList(?string $toDoList): self
    {
        $this->toDoList = $toDoList;

        return $this;
    }
}
