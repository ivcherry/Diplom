<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 10.11.2017
 * Time: 21:47
 */

namespace App\Repositories;

use App\Entities\ProductOrder;
use App\Repositories\Base\GenericRepository;
use Doctrine\ORM\EntityManager;

class ProductOrderRepository extends GenericRepository
{
    public function __construct(EntityManager $entityManager)
    {
        parent::__construct($entityManager, ProductOrder::class);
    }
}