<?php

namespace App\Repository;

use App\Entity\Property;
use App\Entity\PropertySearch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Property|null find($id, $lockMode = null, $lockVersion = null)
 * @method Property|null findOneBy(array $criteria, array $orderBy = null)
 * @method Property[]    findAll()
 * @method Property[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PropertyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Property::class);
    }

    /**
     * @param PropertySearch $search
     * @return Query
     */
    public function findAllVisibleQuery( PropertySearch $search): Query
    {
        $query =  $this->findVisibleQuery();
        if ($search->getMaxPrice()) {
            $query = $query
                ->andWhere('p.price < :maxprice')
                ->setParameter('maxprice', $search->getMaxPrice());
        }

        if ($search->getMinSurface()) {
            $query = $query
                ->andWhere('p.surface >= :minsurface')
                ->setParameter('minsurface', $search->getMinSurface());
        }

        if ($search->getOptions()->count() > 0) {
            $k = 0;
            foreach ($search->getOptions() as $option) {
                $k++;
                $query = $query
                    ->andWhere(":option$k MEMBER OF p.options")
                    ->setParameter("option$k" ,$option);
            }
        }
        return $query->getQuery();
    }

    /**
     * @return Property[]
     */
    public  function findLatest(): array
    {
        return $this->findVisibleQuery()
            ->setMaxResults(3)
            ->getQuery()
            ->getResult();
    }

    /**
     * @return Property[]
     */
    public  function findTwelve(): array
    {
        return $this->findVisibleQuery()
            ->setMaxResults(12)
            ->getQuery()
            ->getResult();
    }

    /**
     * @return array
     */
    public function count_all(): array
    {
        return($this->createQueryBuilder('p')
            ->select('count(p.id)')
            ->where('p.sold = false')
            ->getQuery()
            ->getResult());
    }

    /**
     * @return array
     */
    public function count_all_sale(): array
    {
        return($this->createQueryBuilder('p')
            ->select('count(p.id)')
            ->andwhere('p.sold = false')
            ->andWhere('p.type = 0')
            ->getQuery()
            ->getResult());
    }

    /**
     * @return array
     */
    public function count_all_rental(): array
    {
        return($this->createQueryBuilder('p')
            ->select('count(p.id)')
            ->andwhere('p.sold = false')
            ->andWhere('p.type = 1')
            ->getQuery()
            ->getResult());
    }
    /**
     * @return array
     */
    public function count_unavailable(): array
    {
        return($this->createQueryBuilder('p')
            ->select('count(p.id)')
            ->andwhere('p.sold = true')
            ->getQuery()
            ->getResult());
    }
    /**
     * @return QueryBuilder
     */
    private function findVisibleQuery(): QueryBuilder
    {
        return $this->createQueryBuilder('p')
            ->where('p.sold = false');
    }
}
