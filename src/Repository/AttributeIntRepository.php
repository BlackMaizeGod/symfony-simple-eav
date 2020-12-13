<?php

namespace App\Repository;

use App\Entity\AttributeInt;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AttributeInt|null find($id, $lockMode = null, $lockVersion = null)
 * @method AttributeInt|null findOneBy(array $criteria, array $orderBy = null)
 * @method AttributeInt[]    findAll()
 * @method AttributeInt[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AttributeIntRepository extends ServiceEntityRepository
{
    /**
     * AttributeIntRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AttributeInt::class);
    }

    // /**
    //  * @return AttributeInt[] Returns an array of AttributeInt objects
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
    public function findOneBySomeField($value): ?AttributeInt
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
