<?php

namespace App\Entity;

use App\Repository\AttributeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AttributeRepository::class)
 * @ORM\Table(name="attribute",
 *    uniqueConstraints={
 *        @ORM\UniqueConstraint(name="UNIQ_ATTRIBUTE_CODE",
 *            columns={"code"})
 *    }
 * )
 */
class Attribute
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
    private $code;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $label;

    /**
     * @ORM\ManyToOne(targetEntity=AttributeType::class, inversedBy="attributes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $type;

    /**
     * @ORM\OneToMany(targetEntity=AttributeInt::class, mappedBy="attribute", orphanRemoval=true)
     */
    private $intAttributes;

    /**
     * @ORM\OneToMany(targetEntity=AttributeDecimal::class, mappedBy="attribute", orphanRemoval=true)
     */
    private $decimalAttributes;

    /**
     * @ORM\OneToMany(targetEntity=AttributeVarchar::class, mappedBy="attribute", orphanRemoval=true)
     */
    private $varcharAttributes;

    public function __construct()
    {
        $this->intAttributes = new ArrayCollection();
        $this->decimalAttributes = new ArrayCollection();
        $this->varcharAttributes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getType(): ?AttributeType
    {
        return $this->type;
    }

    public function setType(?AttributeType $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection|AttributeInt[]
     */
    public function getIntAttributes(): Collection
    {
        return $this->intAttributes;
    }

    public function addIntAttribute(AttributeInt $intAttribute): self
    {
        if (!$this->intAttributes->contains($intAttribute)) {
            $this->intAttributes[] = $intAttribute;
            $intAttribute->setAttribute($this);
        }

        return $this;
    }

    public function removeIntAttribute(AttributeInt $intAttribute): self
    {
        if ($this->intAttributes->contains($intAttribute)) {
            $this->intAttributes->removeElement($intAttribute);
            // set the owning side to null (unless already changed)
            if ($intAttribute->getAttribute() === $this) {
                $intAttribute->setAttribute(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|AttributeDecimal[]
     */
    public function getDecimalAttributes(): Collection
    {
        return $this->decimalAttributes;
    }

    public function addDecimalAttribute(AttributeDecimal $decimalAttribute): self
    {
        if (!$this->decimalAttributes->contains($decimalAttribute)) {
            $this->decimalAttributes[] = $decimalAttribute;
            $decimalAttribute->setAttribute($this);
        }

        return $this;
    }

    public function removeDecimalAttribute(AttributeDecimal $decimalAttribute): self
    {
        if ($this->decimalAttributes->contains($decimalAttribute)) {
            $this->decimalAttributes->removeElement($decimalAttribute);
            // set the owning side to null (unless already changed)
            if ($decimalAttribute->getAttribute() === $this) {
                $decimalAttribute->setAttribute(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|AttributeVarchar[]
     */
    public function getVarcharAttributes(): Collection
    {
        return $this->varcharAttributes;
    }

    public function addVarcharAttribute(AttributeVarchar $varcharAttribute): self
    {
        if (!$this->varcharAttributes->contains($varcharAttribute)) {
            $this->varcharAttributes[] = $varcharAttribute;
            $varcharAttribute->setAttribute($this);
        }

        return $this;
    }

    public function removeVarcharAttribute(AttributeVarchar $varcharAttribute): self
    {
        if ($this->varcharAttributes->contains($varcharAttribute)) {
            $this->varcharAttributes->removeElement($varcharAttribute);
            // set the owning side to null (unless already changed)
            if ($varcharAttribute->getAttribute() === $this) {
                $varcharAttribute->setAttribute(null);
            }
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param string $label
     */
    public function setLabel(string $label): void
    {
        $this->label = $label;
    }

    public function __toString()
    {
        return $this->code;
    }
}
