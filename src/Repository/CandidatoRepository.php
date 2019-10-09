<?php

namespace App\Repository;

use App\Entity\Candidato;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Candidato|null find($id, $lockMode = null, $lockVersion = null)
 * @method Candidato|null findOneBy(array $criteria, array $orderBy = null)
 * @method Candidato[]    findAll()
 * @method Candidato[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CandidatoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Candidato::class);
    }

    public function persist(Candidato $instance)
    {
        $em = $this->getEntityManager();
        $em->beginTransaction();
        $em->persist($instance);
        $em->commit();
        $em->flush();
    }

    public function save(Candidato $instance)
    {
        $em = $this->getEntityManager();
        $em->beginTransaction();
        $em->merge($instance);
        $em->commit();
        $em->flush();
    }

    public function remove(Candidato $instance)
    {
        $em = $this->getEntityManager();
        $em->beginTransaction();
        $em->remove($instance);
        $em->commit();
        $em->flush();
    }

    public function findCandidatoPeloEmail($email)
    {
        $em = $this->getEntityManager();

        $query = $em->createQuery('SELECT c.id FROM App:candidato c WHERE c.email LIKE :email');
        $query->setParameter('email', '%'.$email.'%');

        Return $query->execute();
    }

    public function atualizaArea($area)
    {
        $em = $this->getEntityManager();

        $query = $em->createQuery('SELECT c.id FROM App:candidato c WHERE c.email LIKE :email');
        $query->setParameter('email', '%'.$email.'%');

        Return $query->execute();
    }
    // /**
    //  * @return Candidato[] Returns an array of Candidato objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Candidato
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
