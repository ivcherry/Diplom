<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 10.11.2017
 * Time: 21:47
 */

namespace App\Repositories;
use App\Entities\Schedule;
use Doctrine\ORM\EntityManager;
use App\Repositories\Base\GenericRepository;
use App\Entities\PaginationResult;

class ScheduleRepository extends GenericRepository
{
    public function __construct(EntityManager $entityManager)
    {
        parent::__construct($entityManager, Schedule::class);
    }
}