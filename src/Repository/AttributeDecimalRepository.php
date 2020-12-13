<?php

namespace App\Repository;

use App\Entity\AttributeDecimal;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AttributeDecimal|null find($id, $lockMode = null, $lockVersion = null)
 * @method AttributeDecimal|null findOneBy(array $criteria, array $orderBy = null)
 * @method AttributeDecimal[]    findAll()
 * @method AttributeDecimal[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AttributeDecimalRepository extends ServiceEntityRepository
{
    /**
     * AttributeDecimalRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AttributeDecimal::class);
    }

    // /**
    //  * @return AttributeDecimal[] Returns an array of AttributeDecimal objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AttributeDecimal
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
