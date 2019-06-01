<?php

namespace App\Repositories;

use App\Entities\Role;
use App\Repositories\Base\GenericRepository;
use Doctrine\ORM\EntityManager;


class RoleRepository extends GenericRepository
{
    public function __construct(EntityManager $entityManager)
    {
        parent::__construct($entityManager, Role::class);
    }
}
