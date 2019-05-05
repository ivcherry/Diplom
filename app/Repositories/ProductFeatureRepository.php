<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 10.11.2017
 * Time: 21:47
 */

namespace App\Repositories;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManager;
use App\Repositories\Base\GenericRepository;
use App\Entities\ProductFeature;

class ProductFeatureRepository extends GenericRepository
{
    public function __construct(EntityManager $entityManager)
    {
        parent::__construct($entityManager, ProductFeature::class);
    }

    public function getByProductIdAndFeatureId($productId, $featureId){
       $qb = $this->em->createQueryBuilder();

       $result = $qb->select('pf')
                   ->from($this->model, 'pf')
                   ->where('pf.product = '.$productId.' AND pf.feature = '.$featureId)
                   ->getQuery()
                   ->getResult();

       return new ArrayCollection($result);
    }

    public function deleteByProductId($productId){

        $qb = $qb = $this->em->createQueryBuilder();

        $result = $qb->delete($this->model, 'pf')
            ->where('pf.product = :productId')
            ->setParameter('productId', $productId)
            ->getQuery()
            ->getResult();

        return $result;
    }
}