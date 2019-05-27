<?php

namespace App\Repository;

use App\Entity\Evenements;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\ORM\Query;
use App\Entity\EvenementsSearch;
use Doctrine\ORM\QueryBuilder;

/**
 * @method Evenements|null find($id, $lockMode = null, $lockVersion = null)
 * @method Evenements|null findOneBy(array $criteria, array $orderBy = null)
 * @method Evenements[]    findAll()
 * @method Evenements[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EvenementsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Evenements::class);
    }

    /**
     * @return Query
     */
    public function findAllFutureEvents(): Query
    {
        return $this->findFutureEvents()
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @return Query
     */
    public function findIdIntervalEvents(EvenementsSearch $search): Query
    {
        $query= $this->findFutureEvents();

        if ($search->getMaxId()) {
            $query = $query
                ->andwhere('e.id <= :maxid')
                ->setParameter('maxid', $search->getMaxId());
        }

        if ($search->getMinId()) {
            $query = $query
                ->andwhere('e.id >= :minid')
                ->setParameter('minid', $search->getMinId());
        }

        if($search->getLat() && $search->getLng() && $search->getDistance()) {
            $query = $query
                ->select('e')
                ->andWhere('(6353 * 2 * ASIN(SQRT( POWER(SIN((e.lat - :lat) *  pi()/180 / 2), 2) + COS(e.lat *
                pi()/180) * COS(:lat * pi()/180) * POWER(SIN((e.lng - :lng) * pi()/180 / 2), 2) ))) <= :distance')
                ->setParameter('lng', $search->getLng())
                ->setParameter('lat', $search->getLat())
                ->setParameter('distance', $search->getDistance());


        }

        return $query->getQuery();
           
    }

    /**
     * @return Query
     */
    public function findFutureEvents(): QueryBuilder
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.date <= :dateactuelle')
            ->setParameter('dateactuelle', new \Datetime('now'))
            //->getQuery()
            //->getResult()
        ;
    }

    // /**
    //  * @return Evenements[] Returns an array of Evenements objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Evenements
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
