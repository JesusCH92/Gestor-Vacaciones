<?php

namespace App\Repository;

use App\Entity\DayOffForm;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DayOffForm|null find($id, $lockMode = null, $lockVersion = null)
 * @method DayOffForm|null findOneBy(array $criteria, array $orderBy = null)
 * @method DayOffForm[]    findAll()
 * @method DayOffForm[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DayOffFormRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DayOffForm::class);
    }

    // /**
    //  * @return DayOffForm[] Returns an array of DayOffForm objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DayOffForm
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
