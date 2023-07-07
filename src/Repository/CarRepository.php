<?php

declare(strict_types=1);

namespace App\Repository;

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
     * @return \Doctrine\ORM\Query
     */
    public function findWithSearch(array $filters)
    {
        $query = $this->createQueryBuilder('v')
            ->select('c', 'v')
            ->join('v.category', 'c')
        ;

        if (!empty($filters['categories'])) {
            $query = $query
                ->andWhere('c.id IN (:categories)')
                ->setParameter('categories', $filters['categories'])
            ;
        }

        // Cas de la barre de recherche demander par un user
        if (!empty($filters['name'])) {
            $query = $query
                ->andWhere('v.name LIKE :string')
                ->setParameter('string', $filters['name'] . '%')
            ;
        }

        return $query->getQuery();
    }

    public function paginationQuery()
    {
        $query = $this->createQueryBuilder('v')
            ->select('c', 'v')
            ->join('v.category', 'c')
        ;

        return $query->getQuery();
    }
}
