<?php

namespace App\Repositories;

use App\Entities\Order;
use App\Repositories\Base\GenericRepository;
use App\Entities\PaginationResult;
use Doctrine\ORM\EntityManager;

class OrderRepository extends GenericRepository
{
    public function __construct(EntityManager $entityManager)
    {
        parent::__construct($entityManager, Order::class);
    }
    public function getOrderByTitle($title)
    {
        return $this->repo->findOneBy(['title' => $title]);
    }

    public function getPaginate($pageSize,$pageNumber){
        $query = $this->repo->createQueryBuilder($this->model);

        $query = $query
            ->orderBy($this->model.'.id')
            ->setMaxResults($pageSize)
            ->setFirstResult($pageSize*($pageNumber-1))
            ->getQuery();
        $orders = $query->execute();

        $count = $this->repo->createQueryBuilder('t')
            ->select('count(t.id)')
            ->getQuery()
            ->getSingleScalarResult();

        return new PaginationResult($orders, $count);
    }
}
