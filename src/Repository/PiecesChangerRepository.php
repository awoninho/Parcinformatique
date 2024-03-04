<?php

namespace App\Repository;

use App\Entity\PiecesChanger;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PiecesChanger>
 *
 * @method PiecesChanger|null find($id, $lockMode = null, $lockVersion = null)
 * @method PiecesChanger|null findOneBy(array $criteria, array $orderBy = null)
 * @method PiecesChanger[]    findAll()
 * @method PiecesChanger[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PiecesChangerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PiecesChanger::class);
    }

//    /**
//     * @return PiecesChanger[] Returns an array of PiecesChanger objects
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

//    public function findOneBySomeField($value): ?PiecesChanger
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
