<?php

namespace App\Repository;

use App\Classe\Search;
use App\Entity\Car;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Car>
 *
 * @method Car|null find($id, $lockMode = null, $lockVersion = null)
 * @method Car|null findOneBy(array $criteria, array $orderBy = null)
 * @method Car[]    findAll()
 * @method Car[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Car::class);
    }

    /**
     * Requête me permettant de récupérer mes voitures en fontion de la barre de recherche
     * @return Car[]
     */
    public function findWithSearch(Search $search)
    {
        $query = $this
            ->createQueryBuilder('v')
            ->select('c','v')
            ->join('v.category', 'c');
    
    
        if(!empty($search->categories)){
            $query = $query
                ->andWhere('c.id IN (:categories)')
                ->setParameter('categories', $search->categories);
        }
    
        //Cas de la barre de recherche demander par un user
        if(!empty($search->string)){
            $query = $query
                ->andWhere('v.name LIKE :string')
                ->setParameter('string', "%{$search->string}%");
        }
    
        return $query->getQuery()->getResult();
    }

    
    public function paginationQuery()
    {
        return $this->createQueryBuilder('c')
            ->orderBy('c.id', 'ASC')
            ->getQuery()
        ;
    }


    /*public function save(Car $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Car $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }*/



//    public function findOneBySomeField($value): ?Cars
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
