<?php

namespace App\Repository;

use App\Entity\Vids;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Vids|null find($id, $lockMode = null, $lockVersion = null)
 * @method Vids|null findOneBy(array $criteria, array $orderBy = null)
 * @method Vids[]    findAll()
 * @method Vids[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VidsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Vids::class);
    }

    // /**
    //  * @return Vids[] Returns an array of Vids objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Vids
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
