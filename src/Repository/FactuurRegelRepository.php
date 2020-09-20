<?php

namespace App\Repository;

use App\Entity\FactuurRegel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method FactuurRegel|null find($id, $lockMode = null, $lockVersion = null)
 * @method FactuurRegel|null findOneBy(array $criteria, array $orderBy = null)
 * @method FactuurRegel[]    findAll()
 * @method FactuurRegel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FactuurRegelRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FactuurRegel::class);
    }

    // /**
    //  * @return FactuurRegel[] Returns an array of FactuurRegel objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FactuurRegel
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
