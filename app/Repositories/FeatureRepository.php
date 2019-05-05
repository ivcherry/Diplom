<?php

namespace App\Repositories;

use App\Repositories\Base\GenericRepository;
use Doctrine\ORM\EntityManager;
use App\Entities\Feature;
use App\Entities\PaginationResult;


class FeatureRepository extends GenericRepository
{
    public function __construct(EntityManager $entityManager)
    {
        parent::__construct($entityManager, Feature::class);
    }

    public function getPaginatedFeatures($pageSize,$pageNumber){
        $query = $this->repo->createQueryBuilder($this->model);

        $query = $query
            ->orderBy($this->model.'.id')
            ->setMaxResults($pageSize)
            ->setFirstResult($pageSize*($pageNumber-1))
            ->getQuery();
        $features = $query->execute();

        $count = $this->repo->createQueryBuilder('f')
            ->select('count(f.id)')
            ->getQuery()
            ->getSingleScalarResult();

        return new PaginationResult($features, $count);
    }

}
