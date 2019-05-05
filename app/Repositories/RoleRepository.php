<?php

namespace App\Repositories;

use App\Repositories\Base\GenericRepository;
use Doctrine\ORM\EntityManager;
use App\Entities\Role;


class RoleRepository extends GenericRepository
{
    public function __construct(EntityManager $entityManager)
    {
        parent::__construct($entityManager, Role::class);
    }
}
