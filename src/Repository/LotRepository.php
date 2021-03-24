<?php

namespace App\Repository;

use App\Entity\Lot;
use DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Query\Expr;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Vente;

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
            ->join(Vente::class,'v',Expr\Join::WITH,'v.id=l.vente')
            ->orderBy('v.dateDebut', 'DESC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @return Lot[] Returns an array of Lot objects
     */
    public function findBy9_Week() : array
    {
        $qb=new QueryBuilder($this->_em);
        return $this->createQueryBuilder('l')
            ->join(Vente::class,'v',Expr\Join::WITH,'v.id=l.vente')
            ->where($qb->expr()->between('v.dateDebut','\''.((new DateTime('NOW'))->format('Y-m-d H:i:s')).'\'','\''.((((new DateTime('NOW')))->modify('+7 days'))->format('Y-m-d H:i:s')).'\''))
            ->orderBy('v.dateDebut', 'ASC')
            ->setMaxResults(9)
            ->getQuery()
            ->getResult()
            ;
    }

    /**
     * @return Lot[] Returns an array of Lot objects
     */
    public function findBy9_2Week() : array
    {
        $qb=new QueryBuilder($this->_em);
        return $this->createQueryBuilder('l')
            ->join(Vente::class,'v',Expr\Join::WITH,'v.id=l.vente')
            ->where($qb->expr()->between('v.dateDebut','\''.((((new DateTime('NOW')))->modify('+7 days'))->format('Y-m-d H:i:s')).'\'','\''.((((new DateTime('NOW')))->modify('+14 days'))->format('Y-m-d H:i:s')).'\''))
            ->orderBy('v.dateDebut', 'ASC')
            ->setMaxResults(9)
            ->getQuery()
            ->getResult()
            ;
    }

    /**
     * @return Lot[] Returns an array of Lot objects
     */
    public function findBy9_3Week() : array
    {
        $qb=new QueryBuilder($this->_em);
        return $this->createQueryBuilder('l')
            ->join(Vente::class,'v',Expr\Join::WITH,'v.id=l.vente')
            ->where($qb->expr()->between('v.dateDebut','\''.((((new DateTime('NOW')))->modify('+14 days'))->format('Y-m-d H:i:s')).'\'','\''.((((new DateTime('NOW')))->modify('+21 days'))->format('Y-m-d H:i:s')).'\''))
            ->orderBy('v.dateDebut', 'ASC')
            ->setMaxResults(9)
            ->getQuery()
            ->getResult()
            ;
    }

}
