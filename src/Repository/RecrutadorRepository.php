<?php

namespace App\Repository;

use App\Entity\Recrutador;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Recrutador|null find($id, $lockMode = null, $lockVersion = null)
 * @method Recrutador|null findOneBy(array $criteria, array $orderBy = null)
 * @method Recrutador[]    findAll()
 * @method Recrutador[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RecrutadorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Recrutador::class);
    }

    public function persist(Recrutador $instance)
    {
        $em = $this->getEntityManager();
        $em->beginTransaction();
        $em->persist($instance);
        $em->commit();
        $em->flush();
    }

    public function save(Recrutador $instance)
    {
        $em = $this->getEntityManager();
        $em->beginTransaction();
        $em->merge($instance);
        $em->commit();
        $em->flush();
    }

    public function remove(Recrutador $instance)
    {
        $em = $this->getEntityManager();
        $em->beginTransaction();
        $em->remove($instance);
        $em->commit();
        $em->flush();
    }
    // /**
    //  * @return Recrutador[] Returns an array of Recrutador objects
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
    public function findOneBySomeField($value): ?Recrutador
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
