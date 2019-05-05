<?php

namespace App\Repositories;

use App\Entities\ProductFeature;
use App\Entities\ProductsFilter;
use Doctrine\ORM\EntityManager;
use App\Entities\Product;
use App\Repositories\Base\GenericRepository;
use App\Entities\PaginationResult;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\ORM\Query\ResultSetMappingBuilder;

class ProductRepository extends GenericRepository
{
    public function __construct(EntityManager $entityManager)
    {
        parent::__construct($entityManager, Product::class);
    }


    public function getPaginatedProducts($pageSize,$pageNumber){
        $query = $this->repo->createQueryBuilder($this->model);

        $query = $query
            ->orderBy($this->model.'.id')
            ->setMaxResults($pageSize)
            ->setFirstResult($pageSize*($pageNumber-1))
            ->getQuery();
        $products = $query->execute();

        $count = $this->repo->createQueryBuilder('p')
            ->select('count(p.id)')
            ->getQuery()
            ->getSingleScalarResult();

        return new PaginationResult($products, $count);
    }

    public function getByName($name){
        return $this->repo->findOneBy(['name'=>$name]);
    }

    public function getPaginatedProductsWithFilter(ProductsFilter $filter, $pageSize, $pageNumber){
        $query = $this->repo->createQueryBuilder('p');

        if(!empty($filter->getProductName())){
            $query->where("p.name like '%".$filter->getProductName()."%'");
        }
        if(!empty($filter->getTypeId())){
            $query->where('p.type = :typeId')
                ->setParameter('typeId', $filter->getTypeId());
        }
        if(!empty($filter->getOrderByPrice())){
            if($filter->getOrderByPrice()){
                $query->orderBy('p.price','asc');
            }
            else{
                $query->orderBy('p.price','desc');
            }
        }
        else{
            $query->orderBy('p.id');
        }
        $countQuery = clone $query;
        $count = $countQuery->select('count(p.id)')->getQuery()->getSingleScalarResult();


        $paginatedResultQuery= $query->setMaxResults($pageSize)
            ->setFirstResult($pageSize*($pageNumber-1))
            ->getQuery();

        $result = $paginatedResultQuery->execute();

        return new PaginationResult($result, $count);

    }

    public function getPaginatedProductsByCompatibilityInfo($typeId, $compatibilitiesInfo, $pageSize, $pageNumber){
        $conditions = array();

        foreach ($compatibilitiesInfo as $compatibilityInfo){
            $condition= "(pf.feature_id = '".$compatibilityInfo['feature']."' and pf.value ".$compatibilityInfo['rule']." '".$compatibilityInfo['value']."')";
            array_push($conditions, $condition);
        }
        $conditionsQuery = implode(" or ", $conditions);
        $query = $this->em->getConnection()
            ->prepare("select pf.product_id from product_features as pf 
                                      where pf.product_id in 
                                        (select p.id from products as p where p.type_id = ".$typeId.") 
                                      and ($conditionsQuery)
                                      group by pf.product_id having count(*)>".(count($compatibilitiesInfo)-1));
        $query->execute();
        $productsIds = $query->fetchAll();
        $query = $this->repo->createQueryBuilder('p');

        $query = $query->select('p')
                    ->andWhere('p.id IN (:ids)')
                    ->setParameter('ids', $productsIds);

        $countQuery = clone $query;
        $count = $countQuery->select('count(p.id)')->getQuery()->getSingleScalarResult();
        $products = $query->setMaxResults($pageSize)
            ->setFirstResult($pageSize*($pageNumber-1))
            ->getQuery()
            ->execute();

        return new PaginationResult($products, $count);
    }
}
