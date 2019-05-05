<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 10.11.2017
 * Time: 21:47
 */

namespace App\Repositories;
use App\Entities\WorkScheduler;
use Doctrine\ORM\EntityManager;
use App\Repositories\Base\GenericRepository;
use App\Entities\PaginationResult;

class WorkSchedulerRepository extends GenericRepository
{
    public function __construct(EntityManager $entityManager)
    {
        parent::__construct($entityManager, WorkScheduler::class);
    }
}