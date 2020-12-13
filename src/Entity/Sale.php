<?php

namespace App\Entity;

use App\Repository\SaleRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SaleRepository::class)
 */
class Sale
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="sales")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Product::class, inversedBy="sales")
     * @ORM\JoinColumn(nullable=false)
     */
    private $product;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $saledPrice;

    /**
     * @ORM\Column(type="integer")
     */
    private $saledQty;

    /**
     * @return int
     */
    public function getSaledQty()
    {
        return $this->saledQty;
    }


    public function setSaledQty(int $saledQty): self
    {
        $this->saledQty = $saledQty;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;

        return $this;
    }

    public function getSaledPrice(): ?string
    {
        return $this->saledPrice;
    }

    public function setSaledPrice(string $saledPrice): self
    {
        $this->saledPrice = $saledPrice;

        return $this;
    }
}
