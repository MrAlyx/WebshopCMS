<?php

namespace App\Repository;

use App\Entity\Factuur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Factuur|null find($id, $lockMode = null, $lockVersion = null)
 * @method Factuur|null findOneBy(array $criteria, array $orderBy = null)
 * @method Factuur[]    findAll()
 * @method Factuur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FactuurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Factuur::class);
    }

    // /**
    //  * @return Factuur[] Returns an array of Factuur objects
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
    public function findOneBySomeField($value): ?Factuur
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
