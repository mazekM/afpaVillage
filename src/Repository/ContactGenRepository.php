<?php

namespace App\Repository;

use App\Entity\ContactGen;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ContactGen|null find($id, $lockMode = null, $lockVersion = null)
 * @method ContactGen|null findOneBy(array $criteria, array $orderBy = null)
 * @method ContactGen[]    findAll()
 * @method ContactGen[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContactGenRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ContactGen::class);
    }

    // /**
    //  * @return ContactGen[] Returns an array of ContactGen objects
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
    public function findOneBySomeField($value): ?ContactGen
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
