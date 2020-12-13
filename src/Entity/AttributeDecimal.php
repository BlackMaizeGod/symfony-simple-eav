<?php

namespace App\Entity;

use App\Repository\AttributeDecimalRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AttributeDecimalRepository::class)
 * @ORM\Table(name="attribute_decimal",
 *    uniqueConstraints={
 *        @ORM\UniqueConstraint(name="UNIQ_ATTRIBUTE_DECIMAL_ATTRIBUTE_ID_ENTITY_ID",
 *            columns={"attribute_id", "entity_id"})
 *    }
 * )
 */
class AttributeDecimal
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Attribute::class, inversedBy="decimalAttributes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $attribute;

    /**
     * @ORM\ManyToOne(targetEntity=Product::class, inversedBy="decimalAttributes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $entity;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $value;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAttribute(): ?Attribute
    {
        return $this->attribute;
    }

    public function setAttribute(?Attribute $attribute): self
    {
        $this->attribute = $attribute;

        return $this;
    }

    public function getEntity(): ?Product
    {
        return $this->entity;
    }

    public function setEntity(?Product $entity): self
    {
        $this->entity = $entity;

        return $this;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(string $value): self
    {
        $this->value = $value;

        return $this;
    }
}
