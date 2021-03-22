<?php

namespace App\Repository;

use App\Entity\Lot;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Lot|null find($id, $lockMode = null, $lockVersion = null)
 * @method Lot|null findOneBy(array $criteria, array $orderBy = null)
 * @method Lot[]    findAll()
 * @method Lot[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LotRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Lot::class);
    }

     /**
      * @return Lot[] Returns an array of Lot objects
      */
    public function findBy10last() : array
    {
        return $this->createQueryBuilder('l')
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }


    /*
    public function findOneBySomeField($value): ?Lot
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
