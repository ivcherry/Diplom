<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 10.11.2017
 * Time: 21:47
 */

namespace App\Repositories;
use App\Entities\Sale;
use Doctrine\ORM\EntityManager;
use App\Repositories\Base\GenericRepository;
use App\Entities\PaginationResult;

class SaleRepository extends GenericRepository
{
    public function __construct(EntityManager $entityManager)
    {
        parent::__construct($entityManager, Sale::class);
    }

    public function getSaleByTitle($title)
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
        $sales = $query->execute();

        $count = $this->repo->createQueryBuilder('t')
            ->select('count(t.id)')
            ->getQuery()
            ->getSingleScalarResult();

        return new PaginationResult($sales, $count);
    }
}