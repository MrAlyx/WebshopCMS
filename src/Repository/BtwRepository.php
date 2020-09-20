<?php

namespace App\Repository;

use App\Entity\Btw;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Btw|null find($id, $lockMode = null, $lockVersion = null)
 * @method Btw|null findOneBy(array $criteria, array $orderBy = null)
 * @method Btw[]    findAll()
 * @method Btw[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BtwRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Btw::class);
    }

    // /**
    //  * @return Btw[] Returns an array of Btw objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Btw
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
