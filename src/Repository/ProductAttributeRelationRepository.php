<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Orm\ProductAttributeRelation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ProductAttributeRelationRepository extends ServiceEntityRepository
{
    /**
     * ProductAttributeRelationRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductAttributeRelation::class);
    }

}