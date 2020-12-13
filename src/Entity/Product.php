<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 * @ORM\Table(name="product",
 *    uniqueConstraints={
 *        @ORM\UniqueConstraint(name="UNIQ_PRODUCT_SKU",
 *            columns={"sku"})
 *    }
 * )
 */
class Product
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
    private $sku;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $price;

    /**
     * @ORM\Column(type="integer")
     */
    private $qty;

    /**
     * @ORM\ManyToMany(targetEntity=Category::class, mappedBy="products")
     */
    private $categories;

    /**
     * @ORM\OneToMany(targetEntity=Sale::class, mappedBy="productId")
     */
    private $sales;

    /**
     * @var integer $deficit
     */
    private $deficit;

    /**
     * @var string $updatedAt
     */
    private $updatedAt;

    /**
     * @ORM\OneToMany(targetEntity=AttributeInt::class, mappedBy="entity", orphanRemoval=true)
     */
    private $intAttributes;

    /**
     * @ORM\OneToMany(targetEntity=AttributeDecimal::class, mappedBy="entity", orphanRemoval=true)
     */
    private $decimalAttributes;

    /**
     * @ORM\OneToMany(targetEntity=AttributeVarchar::class, mappedBy="product", orphanRemoval=true)
     */
    private $varcharAttributes;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
        $this->sales = new ArrayCollection();
        $this->intAttributes = new ArrayCollection();
        $this->decimalAttributes = new ArrayCollection();
        $this->varcharAttributes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSku(): ?string
    {
        return $this->sku;
    }

    public function setSku(string $sku): self
    {
        $this->sku = $sku;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return Collection|Category[]
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Category $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
            $category->addProduct($this);
        }

        return $this;
    }

    public function removeCategory(Category $category): self
    {
        if ($this->categories->contains($category)) {
            $this->categories->removeElement($category);
            $category->removeProduct($this);
        }

        return $this;
    }

    /**
     * @return Collection|Sale[]
     */
    public function getSales(): Collection
    {
        return $this->sales;
    }

    public function addSale(Sale $sale): self
    {
        if (!$this->sales->contains($sale)) {
            $this->sales[] = $sale;
            $sale->setProduct($this);
        }

        return $this;
    }

    public function removeSale(Sale $sale): self
    {
        if ($this->sales->contains($sale)) {
            $this->sales->removeElement($sale);
            // set the owning side to null (unless already changed)
            if ($sale->getProduct() === $this) {
                $sale->setProduct(null);
            }
        }

        return $this;
    }

    /**
     * @return int
     */
    public function getQty(): ?int
    {
        return $this->qty;
    }

    /**
     * @param int $qty
     */
    public function setQty(int $qty): void
    {
        $this->qty = $qty;
    }

    /**
     * @return int
     */
    public function getDeficit(): int
    {
        return $this->deficit;
    }

    /**
     * @param int $deficit
     */
    public function setDeficit(int $deficit): void
    {
        $this->deficit = $deficit;
    }

    /**
     * @return string
     */
    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }

    /**
     * @param string $updatedAt
     */
    public function setUpdatedAt(string $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    public function __toString() {
        return (string)('ID: ' . $this->id . ' SKU:' . $this->sku);
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
            $intAttribute->setEntity($this);
        }

        return $this;
    }

    public function removeIntAttribute(AttributeInt $intAttribute): self
    {
        if ($this->intAttributes->contains($intAttribute)) {
            $this->intAttributes->removeElement($intAttribute);
            // set the owning side to null (unless already changed)
            if ($intAttribute->getEntity() === $this) {
                $intAttribute->setEntity(null);
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
            $decimalAttribute->setEntity($this);
        }

        return $this;
    }

    public function removeDecimalAttribute(AttributeDecimal $decimalAttribute): self
    {
        if ($this->decimalAttributes->contains($decimalAttribute)) {
            $this->decimalAttributes->removeElement($decimalAttribute);
            // set the owning side to null (unless already changed)
            if ($decimalAttribute->getEntity() === $this) {
                $decimalAttribute->setEntity(null);
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
            $varcharAttribute->setEntity($this);
        }

        return $this;
    }

    public function removeVarcharAttribute(AttributeVarchar $varcharAttribute): self
    {
        if ($this->varcharAttributes->contains($varcharAttribute)) {
            $this->varcharAttributes->removeElement($varcharAttribute);
            // set the owning side to null (unless already changed)
            if ($varcharAttribute->getEntity() === $this) {
                $varcharAttribute->setEntity(null);
            }
        }

        return $this;
    }
}
