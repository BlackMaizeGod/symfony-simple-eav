<?php

declare(strict_types=1);

namespace App\Service;

use App\Repository\DeficitRepository;
use App\Repository\ProductRepository;
use Doctrine\DBAL\DBALException;

class DeficitParser
{
    /**
     * @var DeficitRepository $deficitRepository
     */
    private $deficitRepository;

    /**
     * @var ProductRepository $productRepository
     */
    private $productRepository;

    /**
     * DeficitParser constructor.
     * @param DeficitRepository $deficitRepository
     * @param ProductRepository $productRepository
     */
    public function __construct(
        DeficitRepository $deficitRepository,
        ProductRepository $productRepository
    ) {
        $this->deficitRepository = $deficitRepository;
        $this->productRepository = $productRepository;
    }

    /**
     * @return array
     * @throws DBALException
     */
    public function getDeficitProducts(): array
    {
        $deficitInventory = $this->deficitRepository->findAll();
        $deficitProductIds = array_keys($deficitInventory);
        $deficitProducts = $this->productRepository->findBy(['id' => $deficitProductIds]);

        foreach ($deficitProducts as $deficitProduct) {
            $productId = $deficitProduct->getId();
            $deficitProduct->setDeficit((int)$deficitInventory[$productId]['need_to_up']);
            $deficitProduct->setUpdatedAt((string)$deficitInventory[$productId]['updated_at']);
        }

        return $deficitProducts;
    }

}