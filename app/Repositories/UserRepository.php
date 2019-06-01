<?php

namespace App\Repositories;

use App\Entities\PaginationResult;
use App\Entities\User;
use App\Repositories\Base\GenericRepository;
use Doctrine\ORM\EntityManager;

class UserRepository extends GenericRepository
{
    public function __construct(EntityManager $entityManager)
    {
        parent::__construct($entityManager, User::class);
    }

    public function findUserByEmail($email)
    {
        return $this->repo->findOneBy(['email' => $email]);
    }

    public function getPaginatedUsers($pageSize, $pageNumber)
    {
        $query = $this->repo->createQueryBuilder($this->model);

        $query = $query
            ->orderBy($this->model . '.id')
            ->setMaxResults($pageSize)
            ->setFirstResult($pageSize * ($pageNumber - 1))
            ->getQuery();
        $users = $query->execute();

        $count = $this->repo->createQueryBuilder('f')
            ->select('count(f.id)')
            ->getQuery()
            ->getSingleScalarResult();

        return new PaginationResult($users, $count);
    }
}
