<?php

namespace App\Repositories;

use App\Entities\Compatibility;
use App\Repositories\Base\GenericRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManager;
use App\Entities\PaginationResult;


class CompatibilityRepository extends GenericRepository{

    public function __construct(EntityManager $entityManager)
    {
        parent::__construct($entityManager, Compatibility::class);
    }

    public function getPaginated($pageSize,$pageNumber){
        $query = $this->repo->createQueryBuilder($this->model);

        $query = $query
            ->orderBy($this->model.'.id')
            ->setMaxResults($pageSize)
            ->setFirstResult($pageSize*($pageNumber-1))
            ->getQuery();
        $compatibilities = $query->execute();

        $count = $this->repo->createQueryBuilder('c')
            ->select('count(c.id)')
            ->getQuery()
            ->getSingleScalarResult();

        return new PaginationResult($compatibilities, $count);
    }

    public function getCompatibilitiesByTypesIds($firstTypeId, $secondTypeId){
        $query = $this->repo->createQueryBuilder('c');

        $query = $query->select('c')
                    ->where('(c.firstType = :firstTypeId and c.secondType = :secondTypeId) or (c.firstType = :secondTypeId and c.secondType = :firstTypeId)')
                    ->setParameters(['firstTypeId' => $firstTypeId, 'secondTypeId' => $secondTypeId])
                    ->getQuery();

        $compatibilities = $query->execute();

        return new ArrayCollection($compatibilities);
    }
}

