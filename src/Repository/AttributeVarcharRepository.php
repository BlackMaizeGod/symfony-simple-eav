<?php

namespace App\Repository;

use App\Entity\AttributeVarchar;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AttributeVarchar|null find($id, $lockMode = null, $lockVersion = null)
 * @method AttributeVarchar|null findOneBy(array $criteria, array $orderBy = null)
 * @method AttributeVarchar[]    findAll()
 * @method AttributeVarchar[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AttributeVarcharRepository extends ServiceEntityRepository
{
    /**
     * AttributeVarcharRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AttributeVarchar::class);
    }

    // /**
    //  * @return AttributeVarchar[] Returns an array of AttributeVarchar objects
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
    public function findOneBySomeField($value): ?AttributeVarchar
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
