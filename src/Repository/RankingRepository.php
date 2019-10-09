<?php

namespace App\Repository;

use App\Entity\Ranking;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Ranking|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ranking|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ranking[]    findAll()
 * @method Ranking[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RankingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ranking::class);
    }

    public function persist(Ranking $instance)
    {
        $em = $this->getEntityManager();
        $em->beginTransaction();
        $em->persist($instance);
        $em->commit();
        $em->flush();
    }

    public function save(Ranking $instance)
    {
        $em = $this->getEntityManager();
        $em->beginTransaction();
        $em->merge($instance);
        $em->commit();
        $em->flush();
    }

    public function remove(Ranking $instance)
    {
        $em = $this->getEntityManager();
        $em->beginTransaction();
        $em->remove($instance);
        $em->commit();
        $em->flush();
    }

    // /**
    //  * @return Ranking[] Returns an array of Ranking objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Ranking
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
