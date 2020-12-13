<?php

namespace App\Entity;

use App\Repository\AttributeIntRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AttributeIntRepository::class)
 * @ORM\Table(name="attribute_int",
 *    uniqueConstraints={
 *        @ORM\UniqueConstraint(name="UNIQ_ATTRIBUTE_INT_ATTRIBUTE_ID_ENTITY_ID",
 *            columns={"attribute_id", "entity_id"})
 *    }
 * )
 */
class AttributeInt
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Attribute::class, inversedBy="intAttributes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $attribute;

    /**
     * @ORM\ManyToOne(targetEntity=Product::class, inversedBy="intAttributes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $entity;

    /**
     * @ORM\Column(type="integer")
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

    public function getValue(): ?int
    {
        return $this->value;
    }

    public function setValue(int $value): self
    {
        $this->value = $value;

        return $this;
    }
}
