<?php

namespace App\Repositories;

use App\Entities\PaginationResult;
use App\Repositories\Base\GenericRepository;
use Doctrine\ORM\EntityManager;
use App\Entities\Type;

class TypeRepository extends GenericRepository
{
    public function __construct(EntityManager $entityManager)
    {
        parent::__construct($entityManager, Type::class);
    }

    public function getTypeByName($name)
    {
        return $this->repo->findOneBy(['name' => $name]);
    }

    public function getPaginatedTypes($pageSize, $pageNumber){
        $query = $this->repo->createQueryBuilder($this->model);

        $query = $query
            ->orderBy($this->model.'.id')
            ->setMaxResults($pageSize)
            ->setFirstResult($pageSize*($pageNumber-1))
            ->getQuery();
        $types = $query->execute();

        $count = $this->repo->createQueryBuilder('t')
            ->select('count(t.id)')
            ->getQuery()
            ->getSingleScalarResult();

        return new PaginationResult($types, $count);
    }
}