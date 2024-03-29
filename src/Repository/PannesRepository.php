<?php

namespace App\Repository;

use App\Entity\Pannes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Pannes>
 *
 * @method Pannes|null find($id, $lockMode = null, $lockVersion = null)
 * @method Pannes|null findOneBy(array $criteria, array $orderBy = null)
 * @method Pannes[]    findAll()
 * @method Pannes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PannesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Pannes::class);
    }

//    /**
//     * @return Pannes[] Returns an array of Pannes objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Pannes
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
