<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 10.11.2017
 * Time: 21:47
 */

namespace App\Repositories;

use App\Entities\WorkScheduler;
use App\Repositories\Base\GenericRepository;
use Doctrine\ORM\EntityManager;

class WorkSchedulerRepository extends GenericRepository
{
    public function __construct(EntityManager $entityManager)
    {
        parent::__construct($entityManager, WorkScheduler::class);
    }
}