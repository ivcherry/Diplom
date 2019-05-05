<?php

namespace App\Repositories;

use App\Repositories\Base\GenericRepository;
use Doctrine\ORM\EntityManager;
use App\Entities\GenericType;
use App\Entities\PaginationResult;


class GenericTypeRepository extends GenericRepository
{
    public function __construct(EntityManager $entityManager)
    {
        parent::__construct($entityManager, GenericType::class);
    }

    public function getGenericTypeByName($name)
    {
        return $this->repo->findOneBy(['name' => $name]);
    }

    public function getPaginatedGenericTypes($pageSize,$pageNumber){
        $query = $this->repo->createQueryBuilder($this->model);

        $query = $query
            ->orderBy($this->model.'.id')
            ->setMaxResults($pageSize)
            ->setFirstResult($pageSize*($pageNumber-1))
            ->getQuery();
        $genericTypes = $query->execute();

        $count = $this->repo->createQueryBuilder('t')
            ->select('count(t.id)')
            ->getQuery()
            ->getSingleScalarResult();

        return new PaginationResult($genericTypes, $count);
    }
}