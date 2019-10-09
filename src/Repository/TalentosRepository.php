<?php

namespace App\Repository;

use App\Entity\Talentos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Talentos|null find($id, $lockMode = null, $lockVersion = null)
 * @method Talentos|null findOneBy(array $criteria, array $orderBy = null)
 * @method Talentos[]    findAll()
 * @method Talentos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TalentosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Talentos::class);
    }

    public function persist(Talentos $instance)
    {
        $em = $this->getEntityManager();
        $em->beginTransaction();
        $em->persist($instance);
        $em->commit();
        $em->flush();
    }

    public function save(Talentos $instance)
    {
        $em = $this->getEntityManager();
        $em->beginTransaction();
        $em->merge($instance);
        $em->commit();
        $em->flush();
    }

    public function remove(Talentos $instance)
    {
        $em = $this->getEntityManager();
        $em->beginTransaction();
        $em->remove($instance);
        $em->commit();
        $em->flush();
    }
    // /**
    //  * @return Talentos[] Returns an array of Talentos objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Talentos
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
